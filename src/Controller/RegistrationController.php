<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\RegistrationFormType;
use App\Repository\MemberRepository;
use App\Security\AppMemberAuthenticator;
use App\Service\AlertBootstrapInterface;
use App\Service\MailerServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends AbstractController
{
    /**
     * @var AlertBootstrapInterface
     */
    private $alertBootstrap;
    /**
     * @var VerifyEmailHelperInterface
     */
    private $verifyEmailHelper;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RegistrationController constructor.
     * @param AlertBootstrapInterface $alertBootstrap
     * @param VerifyEmailHelperInterface $verifyEmailHelper
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(AlertBootstrapInterface $alertBootstrap, VerifyEmailHelperInterface $verifyEmailHelper, EntityManagerInterface $entityManager)
    {
        $this->alertBootstrap = $alertBootstrap;
        $this->verifyEmailHelper = $verifyEmailHelper;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailerServiceInterface $mailerService
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerServiceInterface $mailerService): Response
    {
        $user = new Member();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword($passwordEncoder->encodePassword($user, $form->get('plainPassword')->getData()));
            $user->setRoles([Member::MEMBER_ROLE_USER]);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $signatureComponent = $this->verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );

            $mailerService->send(
                ['registration@ft4a.fr', 'ft4a - Création de compte'],
                $user->getEmail(),
                'ft4a.fr - Veuillez confirmer votre adresse e-mail',
                'registration/email/register.mjml.twig',
                'registration/email/register.txt.twig',
                [
                    'signedUrl' => $signatureComponent->getSignedUrl(),
                    'expiresAtMessageKey' => $signatureComponent->getExpirationMessageKey(),
                    'expiresAtMessageData' => $signatureComponent->getExpirationMessageData(),
                ]
            );

            $this->alertBootstrap->success('Un email vous a été envoyé pour finir votre inscription.');

            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     * @param Request $request
     * @param MemberRepository $memberRepository
     * @param GuardAuthenticatorHandler $guardHandler
     * @param AppMemberAuthenticator $authenticator
     * @return Response
     */
    public function verifyUserEmail(Request $request, MemberRepository $memberRepository, GuardAuthenticatorHandler $guardHandler, AppMemberAuthenticator $authenticator): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_home');
        }

       $user = $memberRepository->find($id);

       if (null === $user) {
           return $this->redirectToRoute('app_home');
       }

        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
            $user->setIsVerified(true);
            $user->setIsActive(true);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->alertBootstrap->danger($exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        $this->alertBootstrap->success('Votre email est vérifié et votre compte est activé.');

        $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main' // firewall name in security.yaml
        );

        return $this->redirectToRoute('app_home');
    }
}
