<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("pages")
 */
class PagesController extends Controller
{
    /**
     * @Route("/about",name="pageAbout")
     */
    public function aboutAction()
    {
        return $this->render('@App/Pages/about.html.twig');
    }

    /**
     * @Route("/contacts",name="pageContacts")
     */
    public function contactsAction()
    {
        return $this->render('@App/Pages/contacts.html.twig');
    }

}
