<?php

namespace NS\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hip\MandrillBundle\Dispatcher;

use NS\ContactBundle\Entity\Enquiry;
use NS\ContactBundle\Form\EnquiryType;

class ContactController extends Controller
{
    public function indexAction()
    {
    	$enquiry = new Enquiry();
		$form = $this->createForm(new EnquiryType(), $enquiry);

		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {
		    $form->handleRequest($request);

		    if ($form->isValid()) {

				$message = \Swift_Message::newInstance();

        		if($this->container->getParameter('ns_contact.subject'))
        			$message->setSubject($this->container->getParameter('ns_contact.subject'));
        		else
        			$message->setSubject('Formulaire de contact');

				$from_name = null;
        		if($this->container->getParameter('ns_contact.sender_name'))
        			$from_name = $this->container->getParameter('ns_contact.sender_name');

       			$message->setFrom($this->container->getParameter('ns_contact.emailto'), $from_name);
        		$message->addTo($this->container->getParameter('ns_contact.emailto'));

                $message->setContentType("text/html");

        		if($this->container->getParameter('ns_contact.template'))
        			$view = $this->container->getParameter('ns_contact.template');
        		else
        			$view = 'NSContactBundle:Emails:template.html.twig';

        		$message->setBody($this->renderView($view, array('enquiry' => $enquiry)));

				$this->get('mailer')->send($message);


		        return $this->redirect($this->generateUrl($this->container->getParameter('ns_contact.success_url')));
		    }
		}
        return $this->render('NSContactBundle:Contact:index.html.twig', array(
            'form' => $form->createView()
        ));    
    }

}
