<?php

namespace App\MessageHandler;

use App\Entity\Meal;
use App\Message\MealCreatedNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;


class MealCreatedNotificationHandler implements MessageHandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(MealCreatedNotification $message)
    {
        // Logic to notify the admin about the new meal
        // You can use Swift Mailer or any other method here.
        // ...

        // You may also update the meal status here if needed.
        $meal = $message->getMeal();
        $meal->setIsVerified(false);
        $this->entityManager->persist($meal);
        $this->entityManager->flush();
    }
}
