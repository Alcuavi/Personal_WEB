<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\CurriculumService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class WebController extends AbstractController
{

    private $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    #[Route('/', name: 'redirect_to_locale', methods: ['GET'])]
    public function redirectToLocale(): RedirectResponse
    {
        // Redirigir al idioma predeterminado, por ejemplo 'es'
        return $this->redirectToRoute('home_page', ['_locale' => 'es']);
    }

    #[Route('/{_locale}/', name: 'home_page', requirements: ['_locale' => 'en|es'], methods: ['GET'])]
    public function home(): Response
    {
        $data = $this->curriculumService->getCurriculumData(); // Llamada al servicio

        // Renderiza la plantilla index.html.twig
        return $this->render('web/index.html.twig', $data);
    }

}
