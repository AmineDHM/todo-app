<?php

namespace App\Controller;

use App\Document\Todo;
use App\Service\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/todo", name="todo")
 */
class TestController extends AbstractController
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

        return $this->json(
            ["messge" => "Todo created!", "data" => $todo],
            Response::HTTP_CREATED
        );
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
    public function getById($id): Response
    {
        $todo = $this->todoService->getById($id);
        return $this->json($todo, Response::HTTP_OK);
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
     * @Route("/done/{id}", name="marKDone", methods={"PATCH"})
     */
    public function markDone($id): Response
    {
        $this->todoService->markDone($id);
        return $this->json(["message" => "Todo marked as done"], Response::HTTP_OK);
    }

    /**
     * @Route("/undone/{id}", name="markUndone", methods={"PATCH"})
     */
    public function markUndone($id): Response
    {
        $this->todoService->markUndone($id);
        return $this->json(["message" => "Todo marked as undone"], Response::HTTP_OK);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"DELETE"})
     */
    public function delete($id): Response
    {
        $this->todoService->delete($id);
        return $this->json(["message" => "Todo deleted"], Response::HTTP_OK);
    }
}
