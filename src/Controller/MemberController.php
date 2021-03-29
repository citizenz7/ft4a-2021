<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MemberType;
use App\Service\AlertBootstrapInterface;
use App\Service\FileServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController
 * @package App\Controller
 */
class MemberController extends AbstractController
{
    /**
     * @var AlertBootstrapInterface
     */
    private $alertBootstrap;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var string
     */
    private $pathUploadAvatar;

    /**
     * MemberController constructor.
     * @param AlertBootstrapInterface $alertBootstrap
     * @param EntityManagerInterface $entityManager
     * @param string $pathUploadAvatar
     */
    public function __construct(AlertBootstrapInterface $alertBootstrap, EntityManagerInterface $entityManager, string $pathUploadAvatar)
    {
        $this->alertBootstrap = $alertBootstrap;
        $this->entityManager = $entityManager;
        $this->pathUploadAvatar = $pathUploadAvatar;
    }

    /**
     * @Route("/mon-profile", name="member_profile", methods={"GET"})
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('member/index.html.twig');
    }

    /**
     * @Route("/{id}/edit", name="member_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Member $member
     * @param FileServiceInterface $fileService
     * @return Response
     */
    public function edit(Request $request, Member $member, FileServiceInterface $fileService): Response
    {
        $form = $this->createForm(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $avatarUploadedFile = $form->get('avatar_file')->getData();

            if ($avatarUploadedFile) {
                $fileService->delete($this->pathUploadAvatar, $member->getAvatar());
                $member->setAvatar($fileService->upload($this->pathUploadAvatar, $avatarUploadedFile));
            }

            $this->entityManager->flush();

            $this->alertBootstrap->success('Votre profil a été mis à jour avec succès');

            return $this->redirectToRoute('member_profile');
        }

        return $this->render('member/edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="member_delete", methods={"DELETE"})
     * @param Request $request
     * @param Member $member
     * @return Response
     */
    public function delete(Request $request, Member $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($member);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_home');
    }
}
