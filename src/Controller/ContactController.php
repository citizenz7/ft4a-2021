<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\AlertBootstrapInterface;
use App\Service\MailerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerServiceInterface $mailerService
     * @param ParameterBagInterface $parameterBag
     * @param AlertBootstrapInterface $alertBootstrap
     * @return Response
     */
    public function index(Request $request, MailerServiceInterface $mailerService, ParameterBagInterface $parameterBag, AlertBootstrapInterface $alertBootstrap): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $mailerService->send($parameterBag->get('contact.to'), 'contact/email.html.twig', 'contact/email.txt.twig', ['contact' => $contact]);
            $alertBootstrap->success('Votre message a bien été envoyé !');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
