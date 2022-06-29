<?php

namespace App\Controller;

use App\Document\Todo;
use App\Dto\TodosId;
use App\Service\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/todo", name="todo")
 */
class TodoController extends AbstractController
{
    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * @Route("", name="create", methods={"POST"})
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $todo = $serializer->deserialize($request->getContent(), Todo::class, 'json');
        $errors = $validator->validate($todo);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }
        $this->todoService->create($todo);
        return $this->json($todo, Response::HTTP_CREATED);
    }

    /**
     * @Route("", name="fetchAll", methods={"GET"})
     */
    public function getAll(Request $request): Response
    {
        $sortBy = $request->query->get('sortBy');
        $order = $request->query->get('order');
        $todos = $this->todoService->getAll($sortBy, $order ? $order : 'desc');
        return $this->json($todos, Response::HTTP_OK);
    }

    /**
     * @Route("/get/{id}", name="fetchById", methods={"GET"})
     */
    public function getById(Todo $todo): Response
    {
        return $this->json($todo, Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="update", methods={"PATCH"})
     */
    public function update(Todo $todo, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $body = $request->getContent();
        $updatedTodo = $serializer->deserialize($body, Todo::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $todo]);
        $errors = $validator->validate($todo);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }
        $this->todoService->update($updatedTodo);
        return $this->json($updatedTodo);
    }

    /**
     * @Route("/filter", name="filter", methods={"GET"})
     */
    public function filter(Request $request): Response
    {
        $status = $request->query->get('status');
        $todos = $this->todoService->filterByStatus($status);
        return $this->json($todos, Response::HTTP_OK);
    }

    /**
     * @Route("", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, SerializerInterface $serializer): Response
    {
        $todosId = $serializer->deserialize($request->getContent(), TodosId::class, 'json');
        $this->todoService->delete($todosId->getIds());
        return $this->json(["message" => "Selected todos are deleted"], Response::HTTP_OK);
    }
}
