<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReponsesUtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponsesUtilisateursRepository::class)]
#[ApiResource]
class ReponsesUtilisateurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reponsesUtilisateurs')]
    private ?Parties $partie = null;

    #[ORM\ManyToOne(inversedBy: 'reponsesUtilisateurs')]
    private ?Questions $question = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse_user = null;

    #[ORM\Column]
    private ?bool $est_correcte = null;

    #[ORM\Column]
    private ?int $points_gagnes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartie(): ?Parties
    {
        return $this->partie;
    }

    public function setPartie(?Parties $partie): static
    {
        $this->partie = $partie;

        return $this;
    }

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponseUser(): ?string
    {
        return $this->reponse_user;
    }

    public function setReponseUser(string $reponse_user): static
    {
        $this->reponse_user = $reponse_user;

        return $this;
    }

    public function isEstCorrecte(): ?bool
    {
        return $this->est_correcte;
    }

    public function setEstCorrecte(bool $est_correcte): static
    {
        $this->est_correcte = $est_correcte;

        return $this;
    }

    public function getPointsGagnes(): ?int
    {
        return $this->points_gagnes;
    }

    public function setPointsGagnes(int $points_gagnes): static
    {
        $this->points_gagnes = $points_gagnes;

        return $this;
    }
}
