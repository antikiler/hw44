<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductsController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function indexAction()
    {
        return $this->render('@App/Products/index.html.twig', [

        ]);
    }

    /**
     * @Route("/new",name="productNew")
     */
    public function newAction()
    {
        return $this->render('@App/Products/new.html.twig', [

        ]);
    }

    /**
     * @Route("/detail",name="productDetail")
     */
    public function detailAction()
    {
        return $this->render('@App/Products/detail.html.twig', [

        ]);
    }

}
