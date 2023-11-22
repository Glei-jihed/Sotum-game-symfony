<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
#[ApiResource]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse_correct = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: ReponsesUtilisateurs::class)]
    private Collection $reponsesUtilisateurs;

    public function __construct()
    {
        $this->reponsesUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponseCorrect(): ?string
    {
        return $this->reponse_correct;
    }

    public function setReponseCorrect(string $reponse_correct): static
    {
        $this->reponse_correct = $reponse_correct;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, ReponsesUtilisateurs>
     */
    public function getReponsesUtilisateurs(): Collection
    {
        return $this->reponsesUtilisateurs;
    }

    public function addReponsesUtilisateur(ReponsesUtilisateurs $reponsesUtilisateur): static
    {
        if (!$this->reponsesUtilisateurs->contains($reponsesUtilisateur)) {
            $this->reponsesUtilisateurs->add($reponsesUtilisateur);
            $reponsesUtilisateur->setQuestion($this);
        }

        return $this;
    }

    public function removeReponsesUtilisateur(ReponsesUtilisateurs $reponsesUtilisateur): static
    {
        if ($this->reponsesUtilisateurs->removeElement($reponsesUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($reponsesUtilisateur->getQuestion() === $this) {
                $reponsesUtilisateur->setQuestion(null);
            }
        }

        return $this;
    }
}
