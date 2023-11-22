<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $userScore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserScore(): ?int
    {
        return $this->userScore;
    }

    public function setUserScore(?int $userScore): static
    {
        $this->userScore = $userScore;

        return $this;
    }
}
