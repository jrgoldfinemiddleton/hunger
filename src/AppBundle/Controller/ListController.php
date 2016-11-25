<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/list", name="user_list")
     */
    public function userListAction()
    {
        return $this->render('list/index.html.twig');
    }
    
    /**
     * @Route("/list/create", name="user_create")
     */
    public function userCreateAction(Request $request)
    {
        return $this->render('list/create.html.twig');
    }
    
    /**
     * @Route("/list/edit/{id}", name="user_edit")
     */
    public function userEditAction($id, Request $request)
    {
        return $this->render('list/edit.html.twig');
    }
    
    /**
     * @Route("/list/details/{id}", name="user_details")
     */
    public function userDetailsAction($id)
    {
        return $this->render('list/details.html.twig');
    }
}
