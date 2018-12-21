<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TodosController extends AbstractController
{
    public function showTodos(Request $request, Connection $connection)
    {
        if ((int) $request->query->get('all') == 1) {
            $todos = $connection->fetchAll('SELECT t.* FROM todos t');
        } else {
            $todos = $connection->fetchAll('SELECT t.* FROM todos t WHERE completed = 0');
        }

        return $this->render('showTodos.html.twig', ['todos' => $todos]);
    }

    public function completeTodo(Request $request, Connection $connection)
    {
        $connection->executeQuery('UPDATE todos SET completed = 1 WHERE id = ' . ((int) $request->query->get('id')));

        return $this->redirect('/');
    }

    public function uncompleteTodo(Request $request, Connection $connection)
    {
        $connection->executeQuery('UPDATE todos SET completed = 0 WHERE id = ' . ((int) $request->query->get('id')));

        return $this->redirect('/');
    }
}
