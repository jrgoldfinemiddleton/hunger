<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserList;
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
        $lists = $this->getDoctrine()
            ->getRepository('AppBundle:UserList')
            ->findALL();
        
        return $this->render('list/index.html.twig', array(
            'lists' => $lists
        ));
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
