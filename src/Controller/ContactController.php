<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


class ContactController extends AbstractController
{

    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route('/{_locale}/contact', name: 'contact', requirements: ['_locale' => 'en|es'], methods: ['GET', 'POST'])]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // Verificar si es una solicitud AJAX
        if ($request->isXmlHttpRequest()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $contactData = $form->getData();

                try {
                    $email = (new Email())
                        ->from($contactData['email'])
                        ->to('alberto.cuvi@hotmail.com')
                        ->subject('Nuevo mensaje de contacto')
                        ->html("<p><strong>Nombre:</strong> {$contactData['name']}</p>
                                <p><strong>Correo:</strong> {$contactData['email']}</p>
                                <p><strong>Mensaje:</strong> {$contactData['message']}</p>");

                    $mailer->send($email);
                    $this->addFlash('success', $this->translator->trans('Tu mensaje ha sido enviado correctamente.'));

                    return $this->json(['status' => 'success', 'message' => 'Tu mensaje ha sido enviado correctamente.']);
                } catch (\Exception $e) {
                    $this->addFlash('error', $this->translator->trans('Hubo un problema al enviar el mensaje.') . $e->getMessage());

                    return $this->json(['status' => 'error', 'message' => 'Hubo un problema al enviar el mensaje.']);
                }
            }

            return $this->json(['status' => 'error', 'message' => 'Datos no válidos en el formulario.']);
        }

        // Renderizar el formulario para solicitudes normales
        return $this->render('partials/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }

    // Acción para inyectar el formulario de contacto en todas las páginas
    public function contactForm(): Response
    {
        $form = $this->createForm(ContactType::class);

        return $this->render('partials/contact.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
