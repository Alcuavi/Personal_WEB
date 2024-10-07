<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Nombre'), // Placeholder como en tu HTML original
                    'class' => 'nameContact',  // Clase CSS personalizada
                ],
                'label' => false,  // Ocultar etiqueta predeterminada de Symfony
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Correo'), // Placeholder como en tu HTML original
                    'class' => 'nameEmail',  // Clase CSS personalizada
                ],
                'label' => false,  // Ocultar etiqueta predeterminada de Symfony
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => $this->translator->trans('Mensaje'),  // Placeholder como en tu HTML original
                    'class' => 'message',  // Clase CSS personalizada
                ],
                'label' => false,  // Ocultar etiqueta predeterminada de Symfony
            ])
            ->add('send', SubmitType::class, [
                'label' => $this->translator->trans('Contactar'),  // Texto del botón
                'attr' => [
                    'class' => 'bottonSend',  // Clase CSS personalizada
                ],
            ]);
    }
}
