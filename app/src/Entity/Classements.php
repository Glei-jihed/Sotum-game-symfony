<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClassementsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassementsRepository::class)]
#[ApiResource]
class Classements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'classements')]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $score_total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_classement = null;

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

    public function getScoreTotal(): ?int
    {
        return $this->score_total;
    }

    public function setScoreTotal(int $score_total): static
    {
        $this->score_total = $score_total;

        return $this;
    }

    public function getDateClassement(): ?\DateTimeInterface
    {
        return $this->date_classement;
    }

    public function setDateClassement(\DateTimeInterface $date_classement): static
    {
        $this->date_classement = $date_classement;

        return $this;
    }
}
