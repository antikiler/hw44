<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();
        return $this->render('@App/Products/index.html.twig', [
            'products'=>$products
        ]);
    }

    /**
     * @Route("/products/new",name="productNew")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $product = new Product();

        $form_builder = $this->createFormBuilder($product);
        $form_builder->add('name', TextType::class,[
            'label'=>'Наименоване:'
        ]);
        $form_builder->add('description', TextareaType::class,[
            'label'=>"Описание:",
        ]);
        $form_builder->add('price', TextType::class,[
            'label'=>"Цена:"
        ]);
        $form_builder->add('save', SubmitType::class,[
            'label'=>"Добавить"
        ]);

        $form = $form_builder->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("productDetail",['id'=>$product->getId()]);
        }
        return $this->render('@App/Products/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/products/detail/{id}",name="productDetail")
     * @return Response
     */
    public function detailAction($id)
    {
        $id = intval($id);

        if ($id > 0){
            $product = $this->getDoctrine()
                ->getRepository(Product::class)
                ->find($id);

            return $this->render('@App/Products/detail.html.twig', [
                'product'=>$product
            ]);
        }else{
            return $this->redirectToRoute("home");
        }

    }

}
