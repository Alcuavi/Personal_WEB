<?php

namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class CurriculumService
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function getCurriculumData(): array
    {
        // Define la función de traducción usando el traductor actual
        $translator = function ($text) {
            return $this->translator->trans($text);
        };

        // Incluir el archivo y ejecutar la función retornada
        $dataFunction = include __DIR__ . '/../Data/curriculum_data.php';
        return $dataFunction($translator);
    }
}