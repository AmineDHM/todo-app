<?php

namespace App\Controller;

use App\Document\Todo;
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
     * @Route("/new", name="new", methods={"POST"})
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
     * @Route("/get", name="todos", methods={"GET"})
     */
    public function getAll(): Response
    {
        $todos = $this->todoService->getAll();
        return $this->json($todos, Response::HTTP_OK);
    }

    /**
     * @Route("/get/{id}", name="todo", methods={"GET"})
     */
    public function getById(Todo $todo): Response
    {
        return $this->json($todo, Response::HTTP_OK);
    }

    /**
     * @Route("/update/{id}", name="update", methods={"PATCH"})
     */
    public function update(Todo $todo, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $body = $request->getContent();
        $updatedTodo = $serializer->deserialize($body, Todo::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $todo]);
        $errors = $validator->validate($todo);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }
        $this->todoService->update();
        return $this->json($updatedTodo);
    }

    /**
     * @Route("/filter", name="filter", methods={"GET"})
     */
    public function filter(Request $request): Response
    {
        $priority = $request->query->get('priority');
        $todos = $this->todoService->filterByPriority($priority);
        return $this->json($todos, Response::HTTP_OK);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Todo $todo): Response
    {
        $this->todoService->deleteOne($todo);
        return $this->json(["message" => "Todo deleted"], Response::HTTP_OK);
    }

    // TODO : Expose deleteMany()
}
