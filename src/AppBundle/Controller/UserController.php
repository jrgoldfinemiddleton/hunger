<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{    
    /**
     * @Route("/general_user", name="user_dashboard")
     */
    public function userDashboardAction(Request $request)
    {
        return $this->render('general_user/dashboard.html.twig');
    }

}
?>