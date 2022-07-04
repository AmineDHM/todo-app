<?php

namespace App\Service;

use App\Document\Todo;
use App\Repository\TodoRepository;
use Doctrine\ODM\MongoDB\DocumentManager;

class TodoService
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    public function create(Todo $todo): void
    {
        $this->dm->persist($todo);
        $this->dm->flush();
    }

    public function getAll(string $sortBy = null, string $order): array
    {
        if ($sortBy != null) {
            /**
             * @var TodoRepository $repo
             */
            $repo = $this->dm->getRepository(Todo::class);
            return $repo->fetchAndSortAllTodos($sortBy, $order);
        }
        return $this->dm->getRepository(Todo::class)->findAll();
    }

    public function update($todo): void
    {
        $this->dm->flush();
    }

    public function delete(array $todosId): void
    {
        $todos = $this->dm->getRepository(Todo::class)->findBy(['id' => ['$in' => $todosId]]);
        foreach ($todos as $todo) {
            $this->dm->remove($todo);
        }
        $this->dm->flush();
    }

    public function filterByStatus($status): array
    {
        return $this->dm->getRepository(Todo::class)->findBy(['status' => $status]);
    }
}
