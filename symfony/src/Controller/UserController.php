<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Controller\BaseController;
use App\Entity\User;
use App\Form\UserType;

/**
 * @Route("/user")
 */
class UserController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $users = $this->userService->listAll();
        return $this->renderTemplate('user/index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $response = $this->actionAfterSubmit($form, $user, 'user_index');
        if ($response) {
            return $response;
        }

        return $this->renderFormTemplate('user/new.html.twig', ['user' => $user, 'form' => $form]);
    }

    /**
     * @Route("/{userId}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->renderTemplate('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{userId}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $response = $this->actionAfterSubmit($form, $user, 'user_index');
        if ($response) {
            return $response;
        }
        return $this->renderFormTemplate('user/edit.html.twig', ['user' => $user, 'form' => $form]);
    }

    /**
     * @Route("/{userId}", name="user_delete", methods={"POST"})
     */
    public function delete(User $user): Response
    {
        $this->deleteEntity($user);
        return $this->redirectRoute('user_index');
    }
}
