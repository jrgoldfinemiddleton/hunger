<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Blocks Users not affiliated with a FoodBank from accessing a route.
     */
    protected function verifyFoodBankUser()
    {
        $this->denyAccessUnlessGranted('ROLE_BANK_USER', null,
            'Sorry, this page is only accessible to food bank representatives.');
    }

    /**
     * Blocks access to a route if the User is not logged in.
     */
    protected function verifyLoggedIn()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw $this->createAccessDeniedException();
        }
    }
}
