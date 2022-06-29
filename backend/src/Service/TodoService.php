<?php

namespace App\Service;

use App\Document\Todo;
use Doctrine\ODM\MongoDB\DocumentManager;

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

    public function getAll($sortBy = null, $order)
    {
        if ($sortBy != null) {
            $todos = $this->dm->createQueryBuilder(Todo::class)
                ->sort($sortBy, $order)
                ->getQuery()
                ->execute();
            return $todos;
        }
        return $this->dm->getRepository(Todo::class)->findAll();
    }

    public function update()
    {
        $this->dm->flush();
    }

    public function deleteOne($todo)
    {
        $this->dm->remove($todo);
        $this->dm->flush();
    }

    public function delete($todosId)
    {
        foreach ($todosId as $id) {
            $todo = $this->dm->getRepository(Todo::class)->find($id);
            // Skip not found todos.
            if (!$todo) {
                continue;
            }
            $this->dm->remove($todo);
        }
        $this->dm->flush();
    }

    public function filterByPriority($priority)
    {
        return $this->dm->getRepository(Todo::class)->findBy(['priority' => $priority]);
    }
}
