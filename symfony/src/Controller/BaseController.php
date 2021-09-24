<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;

class BaseController extends AbstractController
{
    public function actionAfterSubmit(FormInterface $form, $entity, $route)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->databaseActivity($entity);
            return $this->redirectRoute($route);
        }
    }

    public function deleteEntity($entity)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($entity);
        $entityManager->flush();
    }

    public function databaseActivity($entity)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    public function redirectRoute($route)
    {
        return $this->redirectToRoute($route, [], Response::HTTP_SEE_OTHER);
    }

    public function renderTemplate($template, $result)
    {
        return $this->render($template, $result);
    }

    public function renderFormTemplate($template, $result)
    {
        return $this->renderForm($template, $result);
    }
}
