<?php

namespace App\Service;

use App\Document\Todo;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoService
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function create(Todo $todo)
    {
        $this->dm->persist($todo);
        $this->dm->flush();
    }

    public function getAll()
    {
        return $this->dm->getRepository(Todo::class)->findAll();
    }

    public function getById($id)
    {
        $todo = $this->dm->getRepository(Todo::class)->find($id);
        if (!$todo) {
            throw new NotFoundHttpException('Todo not found');
        }
        return $todo;
    }

    public function update()
    {
    }

    public function toggleDone()
    {
    }

    public function search()
    {
    }

    public function filter()
    {
    }
}
