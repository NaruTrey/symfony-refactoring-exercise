<?php

namespace App\Controller;

use App\Entity\Todo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TodosController extends AbstractController
{
    public function showTodos(Request $request)
    {
        if ((int) $request->query->get('all') == 1) {
            $todos = $this->getDoctrine()->
                    getRepository(Todo::class)->
                    findAll();
        } else {
            $todos = $this->getDoctrine()->
                    getRepository(Todo::class)->
                    findBy(['completed' => 0]);
        }

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }

    public function completeTodo(Request $request)
    {
        $id = (int) $request->query->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $todo = $entityManager->getRepository(Todo::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('No todo found for id ' . $id);
        }

        $todo->setCompleted(1);
        $entityManager->flush();
        
        return $this->redirect('/');
    }

    public function uncompleteTodo(Request $request)
    {
        $id = (int) $request->query->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $todo = $entityManager->getRepository(Todo::class)->find($id);

        if (!$todo) {
            throw $this->createNotFoundException('No todo found for id ' . $id);
        }

        $todo->setCompleted(0);
        $entityManager->flush();

        return $this->redirect('/');
    }
}
