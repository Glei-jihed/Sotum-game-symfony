<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PartiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartiesRepository::class)]
#[ApiResource]
class Parties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'parties')]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_partie = null;

    #[ORM\Column]
    private ?int $score_total = null;

    #[ORM\Column]
    private ?int $niveau_atteint = null;

    #[ORM\OneToMany(mappedBy: 'partie', targetEntity: ReponsesUtilisateurs::class)]
    private Collection $reponsesUtilisateurs;

    public function __construct()
    {
        $this->reponsesUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDatePartie(): ?\DateTimeInterface
    {
        return $this->date_partie;
    }

    public function setDatePartie(\DateTimeInterface $date_partie): static
    {
        $this->date_partie = $date_partie;

        return $this;
    }

    public function getScoreTotal(): ?int
    {
        return $this->score_total;
    }

    public function setScoreTotal(int $score_total): static
    {
        $this->score_total = $score_total;

        return $this;
    }

    public function getNiveauAtteint(): ?int
    {
        return $this->niveau_atteint;
    }

    public function setNiveauAtteint(int $niveau_atteint): static
    {
        $this->niveau_atteint = $niveau_atteint;

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
            $reponsesUtilisateur->setPartie($this);
        }

        return $this;
    }

    public function removeReponsesUtilisateur(ReponsesUtilisateurs $reponsesUtilisateur): static
    {
        if ($this->reponsesUtilisateurs->removeElement($reponsesUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($reponsesUtilisateur->getPartie() === $this) {
                $reponsesUtilisateur->setPartie(null);
            }
        }

        return $this;
    }
}
