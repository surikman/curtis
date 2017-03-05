<?php

namespace Curtis\AppBundle\Controller;

use Curtis\AppBundle\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ThemeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function indexAction()
    {
        return $this->render('@CurtisApp/Theme/index.html.twig');
    }

    /**
     * @param $category
     * @Route("/tema-kategoria/{category}", name="theme-category")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction($category)
    {
        $category = $this->getDoctrine()->getRepository(Entity\ThemeCategory::class)->findByUrlKey($category);
        if (!$category) {
            throw $this->createNotFoundException();
        }

        $allCategories = $this->getDoctrine()->getRepository(Entity\ThemeCategory::class)->findAll();

        return $this->render('@CurtisApp/Theme/category.html.twig', [
            'category'      => $category,
            'allCategories' => $allCategories,
        ]);
    }

    /**
     * @param $themeId
     * @Route("/tema/{themeId}", name="theme-item")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function themeAction($themeId)
    {
        $theme = $this->getDoctrine()->getRepository(Entity\Theme::class)->find($themeId);
        if (!$theme) {
            throw $this->createNotFoundException();
        }

        $allCategories = $this->getDoctrine()->getRepository(Entity\ThemeCategory::class)->findAll();

        return $this->render('@CurtisApp/Theme/theme.html.twig', [
            'theme'         => $theme,
            'allCategories' => $allCategories,
        ]);
    }
}
