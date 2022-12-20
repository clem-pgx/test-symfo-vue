<?php
// src/Controller/DefaultController.php
//https://makina-corpus.com/symfony/creer-application-symfony-vuejs
//https://www.educative.io/answers/how-to-create-a-form-in-vuejs
//https://stackoverflow.com/questions/57281083/symfony-post-request-body-parameters
namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends AbstractController
{
    /**
     * @Route("/app/{slug?}", name="app", requirements={"slug"=".+"})")
     */
    public function app(): Response
    {
        return $this->render('app.html.twig');
    }

    /**
     * @Route("/api/contact", name="contact")")
     */
    public function apiContact(Request $request, ManagerRegistry $doctrine): Response
    {
        $parameters = json_decode($request->getContent(), true);

        // insert into user database
        $user = new User();
        $user->setName($parameters['name']);
        $user->setEmail($parameters['email']);
        $user->setDescription($parameters['description']);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // return response
        return new JsonResponse(['status' => 'ok']);
    }
}