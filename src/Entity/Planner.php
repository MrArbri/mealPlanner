<?php

namespace App\Entity;

use App\Repository\PlannerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlannerRepository::class)]
class Planner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fk_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fk_user = null;

    #[ORM\ManyToOne(inversedBy: 'fk_meal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Meal $fk_meal = null;

    #[ORM\Column(length: 255)]
    private ?string $time = null;

    #[ORM\Column(length: 255)]
    private ?string $day = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkUser(): ?User
    {
        return $this->fk_user;
    }

    public function setFkUser(?User $fk_user): static
    {
        $this->fk_user = $fk_user;

        return $this;
    }

    public function getFkMeal(): ?Meal
    {
        return $this->fk_meal;
    }

    public function setFkMeal(?Meal $fk_meal): static
    {
        $this->fk_meal = $fk_meal;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }
}
