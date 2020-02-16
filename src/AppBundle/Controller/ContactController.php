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
     * @Route("/contactnew", name="contact_new", methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', 'Contact created');

            return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
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
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('@App/contact/show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contact entity.
     *
     * @Route("/contact/{id}/edit", name="contact_edit", methods={"GET", "POST"})
     */
    public function editAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('AppBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
        }

        return $this->render('@App/contact/edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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

        return $this->redirectToRoute('index');
    }

    /**
     * Creates a form to delete a contact entity.
     *
     * @param Contact $contact The contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
