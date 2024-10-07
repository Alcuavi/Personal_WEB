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
        // Cargar los datos desde el archivo src/Data/curriculum_data.php
        return include __DIR__ . '/../Data/curriculum_data.php';
    }
}