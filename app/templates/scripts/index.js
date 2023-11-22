document.addEventListener("DOMContentLoaded", function() {
    const squares = document.querySelectorAll(".blue-square");
    const columns = 8;
    let currentRowIndex = 0;

    function isRowComplete(rowIndex) {
        const startIndex = rowIndex * columns;
        for (let i = startIndex; i < startIndex + columns; i++) {
            if (!squares[i].innerText.trim()) {
                return false;
            }
        }
        return true;
    }

    function validateRowWithServer(rowData, rowIndex, callback) {
        fetch('/validate-row', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'row_data=' + encodeURIComponent(rowData) + '&row_index=' + rowIndex
            })
            .then(response => response.json())
            .then(data => {
                callback(data.isValid);
            });
    }

    squares.forEach((square, index) => {
        square.addEventListener("input", function() {
            if (this.innerText.length > 1) {
                this.innerText = this.innerText.charAt(0);
            }

            if (this.innerText.length === 1 && squares[index + 1]) {
                squares[index + 1].focus();
            }
        });

        square.addEventListener("keydown", function(event) {
            if (event.key === "Delete") {
                this.innerText = "";
                if (index > 0) {
                    squares[index - 1].focus();
                }
                event.preventDefault();
            }
        });

        square.addEventListener("focus", function() {
            const rowIndex = Math.floor(index / columns);
            if (rowIndex !== currentRowIndex) {
                this.blur();
            }
        });

        square.addEventListener("blur", function() {
            const rowIndex = Math.floor(index / columns);
            if (isRowComplete(rowIndex)) {
                const rowData = Array.from(squares).slice(rowIndex * columns, (rowIndex + 1) * columns).map(s => s.innerText).join("");
                validateRowWithServer(rowData, rowIndex, function(isValid) {
                    if (isValid) {
                        currentRowIndex++;
                    } else {
                        alert("La ligne " + (rowIndex + 1) + " n'est pas valide.");
                        squares[rowIndex * columns].focus();
                    }
                });
            }
        });
    });
});