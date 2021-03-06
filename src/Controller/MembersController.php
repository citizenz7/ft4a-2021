<?php

namespace App\Controller;

use App\Entity\Members;
use App\Form\MembersType;
use App\Form\SearchMembersType;
use App\Repository\MembersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/members")
 */
class MembersController extends AbstractController
{
    /**
     * @Route("/", name="members_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
//    public function index(MembersRepository $membersRepository): Response
//    {
//        return $this->render('members/index.html.twig', [
//            'members' => $membersRepository->findAll(),
//        ]);
//    }
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $data = $this->getDoctrine()->getRepository(Members::class)->findBy([], ['date' => 'DESC']);

        $members = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            15
        );

        return $this->render('members/index.html.twig', [
            'members' => $members,
        ]);
    }

    public function searchMembers(Request $request, MembersRepository $repo, PaginatorInterface $paginator): Response
    {
        $searchFormMembers = $this->createForm(SearchMembersType::class);
        $searchFormMembers->handleRequest($request);

        $donnees = $repo->findMembers();

        if ($searchFormMembers->isSubmitted() && $searchFormMembers->isValid())
        {
            $username = $searchFormMembers->getData()->getUsername();
            $donnees = $repo->searchMembers($username);
        }

        // Paginate the results of the query
        $members = $paginator->paginate(
            $donnees, // Doctrine Query, not results
            $request->query->getInt('page', 1), // Define the page parameter
            7 // Items per page
        );

        return $this->render('search/index.html.twig', [
            'members' => $members,
            'searchFormMembers' => $searchFormMembers->createView()
        ]);
    }

    /**
     * @Route("/new", name="members_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $member = new Members();
        $form = $this->createForm(MembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            return $this->redirectToRoute('members_index');
        }

        return $this->render('members/new.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="members_show", methods={"GET"})
     * @param Members $member
     * @return Response
     */
    public function show(Members $member): Response
    {
        return $this->render('members/show.html.twig', [
            'member' => $member,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="members_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Members $member
     * @return Response
     */
    public function edit(Request $request, Members $member): Response
    {
        $form = $this->createForm(MembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('members_index');
        }

        return $this->render('members/edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="members_delete", methods={"DELETE"})
     * @param Request $request
     * @param Members $member
     * @return Response
     */
    public function delete(Request $request, Members $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($member);
            $entityManager->flush();
        }

        return $this->redirectToRoute('members_index');
    }

}
