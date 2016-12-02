<?php
namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationController extends DefaultController
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // Create a new blank user and process the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user, array(
            'entity_manager' => $em,
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            if ($user->getFoodBank()) {
                // User is a food bank rep
                $user->setRole('ROLE_BANK_USER');

            } else {
                // User is a donor
                $user->setRole('ROLE_USER');
            }

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}