<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Star;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class StarController extends FOSRestController
{
    /**
     * @Rest\Get("/api/star")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Star')->findAll();
        if ($restresult === null) {
            return new View("there are no Stars exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;

    }
    /**
     * @Rest\Get("/api/star/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Star')->find($id);
        if ($singleresult === null) {
            return new View("Star not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }
    /**
     * @Rest\Post("/api/star/")
     */
    public function postAction(Request $request)
    {
        $data = new Star();
        $name = $request->get('name');
        $profession = $request->get('profession');
        $career = $request->get('career');

        if(empty($name) || empty($profession) || empty($career)  )
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setName($name);
        $data->setProfession($profession);
        $data->setCareer($career);

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Star Added Successfully", Response::HTTP_OK);
    }
    /**
     * @Rest\Put("/api/star/{id}")
     */
    public function updateAction($id, Request $request)
    {
        $data = new Star();
        $name = $request->get('name');
        $profession = $request->get('profession');
        $career = $request->get('career');

        $sn = $this->getDoctrine()->getManager();
        $star = $this->getDoctrine()->getRepository('AppBundle:Star')->find($id);
        if (empty($star)) {
            return new View("star not found", Response::HTTP_NOT_FOUND);
        }
        elseif(!empty($name) && !empty($profession) && !empty($career)){
            $star->setName($name);
            $star->setProfession($profession);
            $star->setCareer($career);
            $sn->flush();
            return new View("Star Updated Successfully", Response::HTTP_OK);
        }
        elseif(empty($name) && !empty($profession) && empty($career) ){
            $star->setProfession($profession);
            $sn->flush();
            return new View("Role Updated Successfully", Response::HTTP_OK);
        }
        elseif(!empty($name) && empty($profession) && empty($career) ){
            $star->setName($name);
            $sn->flush();
            return new View("Name Updated Successfully", Response::HTTP_OK);
        }
        elseif(empty($name) && empty($profession) && !empty($career) ){
            $star->setCareer($career);
            $sn->flush();
            return new View("Starname Updated Successfully", Response::HTTP_OK);
        }
        else return new View("star name or role or Star name or password cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }
    /**
     * @Rest\Delete("/api/star/{id}")
     */
    public function deleteAction($id)
    {
        $data = new Star();
        $sn = $this->getDoctrine()->getManager();
        $star = $this->getDoctrine()->getRepository('AppBundle:Star')->find($id);
        if (empty($star)) {
            return new View("Star not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($star);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}