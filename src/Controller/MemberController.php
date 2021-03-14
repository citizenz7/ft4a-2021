<?php

namespace App\Controller;

use App\Entity\Member;
use App\Form\MembersType;
use App\Form\SearchMembersType;
use App\Repository\MemberRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MemberController
 * @package App\Controller
 *
 * @Route("/members")
 */
class MemberController extends AbstractController
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
        $data = $this->getDoctrine()->getRepository(Member::class)->findBy([], ['date' => 'DESC']);

        $members = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            15
        );

        return $this->render('members/index.html.twig', [
            'members' => $members,
        ]);
    }

    /**
     * @param Request $request
     * @param MemberRepository $repo
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function searchMembers(Request $request, MemberRepository $repo, PaginatorInterface $paginator): Response
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
        $member = new Member();
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
     * @param Member $member
     * @return Response
     */
    public function show(Member $member): Response
    {
        return $this->render('members/show.html.twig', [
            'member' => $member,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="members_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Member $member
     * @return Response
     */
    public function edit(Request $request, Member $member): Response
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
     * @param Member $member
     * @return Response
     */
    public function delete(Request $request, Member $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($member);
            $entityManager->flush();
        }

        return $this->redirectToRoute('members_index');
    }

}
