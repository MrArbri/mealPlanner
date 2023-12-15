<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealRepository::class)]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredients = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $preparation = null;

    #[ORM\Column(length: 255)]
    private ?string $rating = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $calories = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $prep_time = null;

    #[ORM\ManyToOne(inversedBy: 'meals')]
    private ?User $creator = null;

    #[ORM\OneToMany(mappedBy: 'fk_meal', targetEntity: Planner::class, orphanRemoval: true)]
    private Collection $fk_meal;

    #[ORM\Column]
    private ?bool $is_verified = null;



    public function __construct()
    {
        $this->fk_meal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(string $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCalories(): ?string
    {
        return $this->calories;
    }

    public function setCalories(string $calories): static
    {
        $this->calories = $calories;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPrepTime(): ?\DateTimeInterface
    {
        return $this->prep_time;
    }

    public function setPrepTime(\DateTimeInterface $prep_time): static
    {
        $this->prep_time = $prep_time;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, Planner>
     */
    public function getFkMeal(): Collection
    {
        return $this->fk_meal;
    }

    public function addFkMeal(Planner $fkMeal): static
    {
        if (!$this->fk_meal->contains($fkMeal)) {
            $this->fk_meal->add($fkMeal);
            $fkMeal->setFkMeal($this);
        }

        return $this;
    }

    public function removeFkMeal(Planner $fkMeal): static
    {
        if ($this->fk_meal->removeElement($fkMeal)) {
            // set the owning side to null (unless already changed)
            if ($fkMeal->getFkMeal() === $this) {
                $fkMeal->setFkMeal(null);
            }
        }

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->is_verified;
    }

    public function setIsVerified(bool $is_verified): static
    {
        $this->is_verified = $is_verified;

        return $this;
    }
}
