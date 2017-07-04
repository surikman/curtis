<?php

namespace Curtis\AppBundle\Controller;

use Curtis\AppBundle\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/lokalita/miesto/{id}", name="locality-place")
     * @ParamConverter("place", class="CurtisAppBundle:LocalityPlace")
     * @param Entity\LocalityPlace $place
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function placeAction(Entity\LocalityPlace $place)
    {
        $template = '@CurtisApp/Locality/place.html.twig';
        if ($place->getIsLocked() && !$this->isGranted('ROLE_ADMIN')) {
            $template = '@CurtisApp/Locality/empty-place.html.twig';
        }

        return $this->render($template, [
            'place' => $place,
        ]);
    }
}
