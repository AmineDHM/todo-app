<?php

namespace App\Repository;

use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class TodoRepository extends DocumentRepository
{
    public function fetchAndSortAllTodos(string $sortBy, string $order): array
    {
        return $this->createQueryBuilder()
            ->sort($sortBy, $order)
            ->getQuery()
            ->execute();
    }
}
