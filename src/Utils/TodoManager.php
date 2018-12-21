<?php

namespace App\Utils;

use App\Entity\Todo;
use Doctrine\Common\Persistence\ManagerRegistry;

class TodoManager {

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getTodos($isReturnAll) {
        if ($isReturnAll) {
            $todos = $this->doctrine->
                    getRepository(Todo::class)->
                    findAll();
        } else {
            $todos = $this->doctrine->
                    getRepository(Todo::class)->
                    findBy(['completed' => 0]);
        }
        return $todos;
    }

    public function setCompleted($id, $completed) {
        $entityManager = $this->doctrine->getManager();
        $todo = $entityManager->getRepository(Todo::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('No todo found for id ' . $id);
        }

        $todo->setCompleted($completed);
        $entityManager->flush();
    }

}