<?php

namespace App\Message;

use App\Entity\Meal;

class MealCreatedNotification
{
    private $meal;

    public function __construct(Meal $meal)
    {
        $this->meal = $meal;
    }

    public function getMeal(): Meal
    {
        return $this->meal;
    }
}
