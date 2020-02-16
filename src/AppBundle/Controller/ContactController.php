<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     * @Route("/", name="index", methods={"GET"})
     * @Route("/contacts", name="contact_list", methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('@App/contact/index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Creates a new contact entity.
     *
     * @Route("/contact/new", name="contact_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();

                $this->addFlash('success', 'Contact created');

                return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
            } else {
                $this->addFlash('error', 'Unable to create contact due to errors, please check the form');
            }
        }

        return $this->render('@App/contact/new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contact entity.
     *
     * @Route("/contact/{id}", name="contact_show", methods={"GET"})
     */
    public function showAction(Contact $contact)
    {

        return $this->render('@App/contact/show.html.twig', array(
            'contact' => $contact,
        ));
    }

    /**
     * Displays a form to edit an existing contact entity.
     *
     * @Route("/contact/{id}/edit", name="contact_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Contact $contact)
    {
        $editForm = $this->createForm('AppBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'Contact saved');

                return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
            } else {
                $this->addFlash('error', 'Unable to saved contact due to errors, please check the form');
            }
        }

        return $this->render('@App/contact/edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a contact entity.
     *
     * @Route("/contact/{id}/delete", name="contact_delete")
     */
    public function deleteAction(Request $request, Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        $this->addFlash('success', 'Contact deleted');

        return $this->redirectToRoute('index');
    }
}
