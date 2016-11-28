<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
	/**
	 * @Route ("/general_user", name="general_user")
	 */
	public function generalUserAction()
	{
		return $this->render('general_user/dashboard.html.twig');
	}

	/**
	 * @Route("/login", name="login")
	 */
	public function userloginAction(Request $request)
	{
		return $this->render('login/login.html.twig');
	}

	/**
	 * @Route("/login/signup", name="user_signup)
	 */

#	public function usersignupAction(Request $request)
#	{
#		return $this->render('login/signup.html.twig');
#	}
}

?>