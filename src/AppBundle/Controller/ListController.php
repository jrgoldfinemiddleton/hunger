<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/*
The ListController class Handles the routing for Donation List
items found at http://.../list
Class handles the creation and edit of List items made for Donation Wish List
Templating Lesson: Brad Traversy https://www.youtube.com/watch?v=HchMW8EhWPU
*/
class ListController extends DefaultController
{
    /**
     * @Route("/list", name="user_list")
     */
    public function userListAction()
    {
        $this->verifyLoggedIn();

        $lists = $this->getDoctrine()
            ->getRepository('AppBundle:UserList')
            ->findAll();

        return $this->render('list/index.html.twig', array(
            'lists' => $lists
        ));
    }

    /**
     * @Route("/list/create", name="user_create")
     */
    public function userCreateAction(Request $request)
    {
        $this->verifyLoggedIn();

        // Create a new UserList Donation Item var
        $list = new UserList;

        // $form = $this->createFormBuilder($list)
        //     ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
        //     ->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
        //     ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
        //     ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
        //     ->add('due_date', DateTimeType::class, array('attr' => array('class' => 'formcontrol', 'style' => 'margin-bottom:12px')))
        //     ->add('create', SubmitType::class, array('label' => 'Create Donation Item', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:12px')))
        //     ->getForm();

        // Make an associative Array of Food item names and Ids to populate a popdown menu
        $repositoryFoodItems = $this->getDoctrine()->getRepository('AppBundle:FoodItem');
        $foodItems = $repositoryFoodItems->findAll();
        $foodItemsNameAndId;
        foreach ($foodItems as $element) {
          $foodItemsNameAndId[$element->getName()] = $element;
        }

        // Make an associative Array of Unit names and Ids to populate a popdown menu
        $repositoryUnitItems = $this->getDoctrine()->getRepository('AppBundle:Unit');
        $unitItems = $repositoryUnitItems->findAll();
        $unitItemsNameAndId;
        foreach ($unitItems as $element) {
          $unitItemsNameAndId[$element->getName()] = $element;
        }

        // Create a new form of fields stored in $form var
        $form = $this->createFormBuilder($list)
            ->add('foodItem', ChoiceType::class, array('choices' => $foodItemsNameAndId, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('quantity', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('unit', ChoiceType::class, array('choices' => $unitItemsNameAndId, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('create', SubmitType::class, array('label' => 'Create Donation Item', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:12px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          // $name = $form['name']->getData();
          // $category = $form['category']->getData();
          // $description = $form['description']->getData();
          // $priority = $form['priority']->getData();
          // $due_date = $form['due_date']->getData();

          //Store the data user typed or selected in the form fields in vars
          $foodItem = $form['foodItem']->getData();
          $quantity = $form['quantity']->getData();
          $unit = $form['unit']->getData();


          // $list->setName($name);
          // $list->setCategory($category);
          // $list->setDescription($description);
          // $list->setPriority($priority);

          // Set the values that will be stored in the new UserList Donation Item var
          $list->setFoodItem($foodItem);
          $list->setQuantity($quantity);
          $list->setUnit($unit);

          // Set $list to persist in table
          $em = $this->getDoctrine()->getManager();
          $em->persist($list);
          $em->flush();

          // $this->addFlash(
          //   'Donation Item Created'
          // );
          return $this->redirectToRoute('user_list');
        }

        return $this->render('list/create.html.twig', array(
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/list/edit/{id}", name="user_edit")
     */
    public function userEditAction($id, Request $request)
    {
        $this->verifyLoggedIn();

        // Get chosen UserList Donation Item var
        $list = $this->getDoctrine()
            ->getRepository('AppBundle:UserList')
            ->find($id);

        // Set the values that will be stored in the new UserList Donation Item var
        $list->setFoodItem($list->getFoodItem());
        $list->setQuantity($list->getQuantity());
        $list->setUnit($list->getUnit());

        // Make an associative Array of Food item names and Ids to populate a popdown menu
        $repositoryFoodItems = $this->getDoctrine()->getRepository('AppBundle:FoodItem');
        $foodItems = $repositoryFoodItems->findAll();
        $foodItemsNameAndId;
        foreach ($foodItems as $element) {
          $foodItemsNameAndId[$element->getName()] = $element;
        }

        // Make an associative Array of Unit names and Ids to populate a popdown menu
        $repositoryUnitItems = $this->getDoctrine()->getRepository('AppBundle:Unit');
        $unitItems = $repositoryUnitItems->findAll();
        $unitItemsNameAndId;
        foreach ($unitItems as $element) {
          $unitItemsNameAndId[$element->getName()] = $element;
        }

        // Create a new form of fields stored in $form var
        $form = $this->createFormBuilder($list)
            ->add('foodItem', ChoiceType::class, array('choices' => $foodItemsNameAndId, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('quantity', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('unit', ChoiceType::class, array('choices' => $unitItemsNameAndId, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:12px')))
            ->add('create', SubmitType::class, array('label' => 'Create Donation Item', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:12px')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          //Store the data user typed or selected in the form fields in vars
          $foodItem = $form['foodItem']->getData();
          $quantity = $form['quantity']->getData();
          $unit = $form['unit']->getData();


          // Set $list to persist in table
          $em = $this->getDoctrine()->getManager();
          $list = $em->getRepository('AppBundle:UserList')->find($id);

          // Set the values that will be stored in the new UserList Donation Item var
          $list->setFoodItem($foodItem);
          $list->setQuantity($quantity);
          $list->setUnit($unit);



          $em->flush();

          // $this->addFlash(
          //   'Donation Item Created'
          // );
          return $this->redirectToRoute('user_list');
        }


        return $this->render('list/edit.html.twig', array(
          'list' => $list,
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/list/details/{id}", name="user_details")
     */
    public function userDetailsAction($id)
    {
        $this->verifyLoggedIn();

        return $this->render('list/details.html.twig');
    }

    /**
     * @Route("/bank/list", name="bank_list")
     */
    public function bankListAction()
    {
        $this->verifyLoggedIn();
        $this->verifyFoodBankUser();

        $lists = $this->getDoctrine()
            ->getRepository('AppBundle:FoodBankList')
            ->findAll();

        return $this->render('list/index.html.twig', array(
            'lists' => $lists
        ));
    }

    /**
     * @Route("/bank/list/create", name="bank_create")
     */
    public function bankCreateAction(Request $request)
    {
        $this->verifyLoggedIn();
        $this->verifyFoodBankUser();

        return $this->render('list/create.html.twig');
    }

    /**
     * @Route("/bank/list/edit/{id}", name="bank_edit")
     */
    public function bankEditAction($id, Request $request)
    {
        $this->verifyLoggedIn();
        $this->verifyFoodBankUser();

        return $this->render('list/edit.html.twig');
    }

    /**
     * @Route("/bank/list/details/{id}", name="bank_details")
     */
    public function bankDetailsAction($id)
    {
        $this->verifyLoggedIn();
        $this->verifyFoodBankUser();

        return $this->render('list/details.html.twig');
    }

    /**
     * Displays the request lists of all FoodBank accounts.
     *
     * @Route("/banks/requested", name="bank_requests")
     */
    public function bankRequestListAction()
    {
        $this->verifyLoggedIn();

        $lists = $this->getDoctrine()
            ->getRepository('AppBundle:FoodBankList')
            ->findAll();

        return $this->render('list/index.html.twig', array(
            'lists' => $lists
        ));
    }
}
