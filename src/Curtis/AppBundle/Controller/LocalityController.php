<?php

namespace Curtis\AppBundle\Controller;

use Curtis\AppBundle\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LocalityController extends Controller
{
    /**
     * @Route("/lokalita", name="locality-overview")
     */
    public function indexAction()
    {
        return $this->render('@CurtisApp/Locality/index.html.twig');
    }

    /**
     * @param $stateArea
     *
     * @Route("/lokalita/{stateArea}", name="locality-state-area")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stateAreaAction($stateArea)
    {
        $stateArea = $this->getDoctrine()->getRepository(Entity\LocalityStateArea::class)->findByUrlKey($stateArea);
        if (!$stateArea) {
            throw $this->createNotFoundException();
        }

        return $this->render('@CurtisApp/Locality/state-area.html.twig', [
            'stateArea' => $stateArea,
        ]);
    }

    /**
     * @param $regionId
     *
     * @Route("/lokalita/region/{regionId}", name="locality-region")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function regionAction($regionId)
    {
        $region = $this->getDoctrine()->getRepository(Entity\LocalityRegion::class)->find($regionId);
        if (!$region) {
            throw $this->createNotFoundException();
        }

        return $this->render('@CurtisApp/Locality/region.html.twig', [
            'region' => $region,
        ]);
    }


    /**
     * @param $placeId
     *
     * @Route("/lokalita/miesto/{placeId}", name="locality-place")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function placeAction($placeId)
    {

        $place = $this->getDoctrine()->getRepository(Entity\LocalityPlace::class)->find($placeId);
        if (!$place) {
            throw $this->createNotFoundException();
        }

        return $this->render('@CurtisApp/Locality/place.html.twig', [
            'place' => $place,
        ]);
    }
}
