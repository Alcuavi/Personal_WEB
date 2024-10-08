<?php

namespace App\Controller;

use App\Service\CurriculumService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;


class CurriculumController extends AbstractController
{
    private $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    #[Route('/{_locale}/curriculum', name: 'curriculum', requirements: ['_locale' => 'en|es'], methods: ['GET'])]
    public function index(): Response
    {
        $data = $this->curriculumService->getCurriculumData(); // Llamada al servicio

        return $this->render('curriculum/curriculum.html.twig', $data);
    }

    protected function getCurriculumData(): array
    {
        // Define la función de traducción usando el traductor actual
        $translator = function ($text) {
            return $this->translator->trans($text);
        };

        // Incluir el archivo y ejecutar la función retornada
        $dataFunction = include __DIR__ . '/../Data/curriculum_data.php';
        return $dataFunction($translator);
    }

    #[Route('/curriculum/generate-pdf-script', name: 'generate_pdf_script', methods: ['POST'])]
    public function generatePdfScript(): JsonResponse
    {
        $process = new Process(['node', '/js/generate_pdf.js']);
        $process->run();

        // Comprueba si el proceso falló
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Devuelve una respuesta JSON para indicar que el PDF se ha generado
        return new JsonResponse(['status' => 'PDF generated successfully']);
    }

    #[Route('/api/get-technical-skills', name: 'get_technical_skills', methods: ['GET'])]
    public function getTechnicalSkills(): JsonResponse
    {
        $technicalSkills = $this->getCurriculumData()['technical_skills']; // Ajusta según tu lógica
        return new JsonResponse($technicalSkills);
    }

}
