<?php

namespace NS\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Hip\MandrillBundle\Message;
use Hip\MandrillBundle\Dispatcher;

use NS\ContactBundle\Entity\Enquiry;
use NS\ContactBundle\Form\EnquiryType;

class ContactController extends Controller
{
    public function indexAction()
    {
    	$enquiry = new Enquiry();
		$form = $this->createForm(new EnquiryType(), $enquiry);

		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
		    $form->bind($request);

		    if ($form->isValid()) {

		    	$dispatcher = $this->get('hip_mandrill.dispatcher');

        		$message = new Message();
        		if($this->container->getParameter('ns_contact.subject'))
        			$message->setSubject($this->container->getParameter('ns_contact.subject'));
        		else
        			$message->setSubject('Formulaire de contact');

        		if($this->container->getParameter('ns_contact.sender_name'))
        			$message->setFromName($this->container->getParameter('ns_contact.sender_name'));

       			$message->setFromEmail($this->container->getParameter('ns_contact.emailto'));        		
        		$message->addTo($this->container->getParameter('ns_contact.emailto'));

        		if($this->container->getParameter('ns_contact.template'))
        			$view = $this->container->getParameter('ns_contact.template');
        		else
        			$view = 'NSContactBundle:Emails:template.html.twig';

        		$message->setHtml($this->renderView($view, array('enquiry' => $enquiry)));
				
				$dispatcher->send($message);

		        return $this->redirect($this->generateUrl($this->container->getParameter('ns_contact.success_url')));
		    }
		}
        return $this->render('NSContactBundle:Contact:index.html.twig', array(
            'form' => $form->createView()
        ));    
    }

}
