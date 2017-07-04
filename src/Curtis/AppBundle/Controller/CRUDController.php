<?php

namespace Curtis\AppBundle\Controller;

use Curtis\AppBundle\Entity;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Class CRUDController
 *
 * @package Curtis\AppBundle\Controller
 * @Route("/admin")
 */
class CRUDController extends Controller
{

    /**
     * @Route("/")
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function indexAction()
    {
        return $this->redirectToRoute('home_page');
    }

    /**
     * @param Entity\LocalityRegion $region
     *
     * @ParamConverter("region", class="CurtisAppBundle:LocalityRegion")
     * @Route("/locality/create-place/{id}", name="admin-locality-create-place")
     * @return Response
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function createLocalityAction(Entity\LocalityRegion $region)
    {
        $place = new Entity\LocalityPlace();
        $place->setName('Lokalita');
        $place->setRegion($region);
        $place->setText('');
        $place->setIsLocked(true);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($place);
        $manager->flush();

        return $this->redirectToRoute('locality-place', [
            'id' => $place->getId(),
        ]);
    }

    /**
     * @Route("/locality/toggle-lock-place/{id}", name="admin-locality-toggle-lock-place")
     * @ParamConverter("place", class="CurtisAppBundle:LocalityPlace")
     * @param Entity\LocalityPlace $place
     *
     * @return RedirectResponse
     * @throws \LogicException
     */
    public function toggleLockPlaceAction(Entity\LocalityPlace $place)
    {
        $place->toggleLock();
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($place);
        $manager->flush();

        return $this->redirectToRoute('locality-place', [
            'id' => $place->getId(),
        ]);
    }

    /**
     * @param Request $request
     * @param integer $placeId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \LogicException
     * @Route("/locality/update/{placeId}", name="admin-locality-place-update")
     */
    public function updateLocalityAction(Request $request, $placeId)
    {
        $manager = $this->getDoctrine()->getManager();
        $place = $manager->getRepository(Entity\LocalityPlace::class)->find($placeId);
        if (!$place) {
            throw $this->createNotFoundException();
        }

        if ($request->isMethod(Request::METHOD_POST)) {
            if (null !== ($name = $request->get('name'))) {
                $name = preg_replace('/<[^>]*>/', '', $name);
                $place->setName(trim($name));
            }

            if (null !== ($text = $request->get('text'))) {
                $place->setText($text);
            }
            $manager->persist($place);
            $manager->flush();
        }

        return $this->render('@CurtisApp/Locality/place.html.twig', [
            'place' => $place,
        ]);
    }

    /**
     * @param Request $request
     *
     * @Route("/upload-image", name="admin-upload-image")
     * @return Response
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \LogicException
     */
    public function uploadImageAction(Request $request)
    {
        if (!$request->isMethod(Request::METHOD_POST)) {
            throw $this->createNotFoundException();
        }

        /** @var UploadedFile $image */
        $image = $request->files->get('image');
        $filename = sprintf(
            '%s.%s',
            Uuid::getFactory()->uuid4(),
            $image->guessExtension()
        );
        $target = $image->move($this->getParameter('images_tmp_dir'), $filename);
        $url = sprintf(
            '%s/%s',
            $this->getParameter('image_tmp_web_dir'),
            $target->getFilename()
        );

        $result = [
            'url'  => $url,
            'size' => getimagesize($target->getPathname()),
        ];

        return new Response(json_encode($result));
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException
     * @throws \InvalidArgumentException
     * @Route("/insert-image", name="admin-insert-image")
     */
    public function insertImageAction(Request $request)
    {
        $image = $this->getParameter('web_dir') . $request->get('url');

        $file = new File($image);
        $target = $file->move($this->getParameter('images_dir'), $file->getFilename());
        $url = sprintf(
            '%s/%s',
            $this->getParameter('image_web_dir'),
            $target->getFilename()
        );

        $result = [
            'url'  => $url,
            'size' => getimagesize($target->getPathname()),
        ];

        return new Response(json_encode($result));

    }
}