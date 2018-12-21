<?php

namespace App\Controller;

use App\Utils\TodoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TodosController extends AbstractController {

    public function showTodos(Request $request, TodoManager $todoManager) {
        $todos = $todoManager->getTodos((int) $request->query->get('all'));

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }

    public function completeTodo(Request $request, TodoManager $todoManager) {
        $todoManager->setCompleted((int) $request->query->get('id'), 1);

        return $this->redirect('/');
    }

    public function uncompleteTodo(Request $request, TodoManager $todoManager) {
        $todoManager->setCompleted((int) $request->query->get('id'), 0);

        return $this->redirect('/');
    }

}
