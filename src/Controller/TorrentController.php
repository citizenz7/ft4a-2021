<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Torrent;
use App\Form\CommentsType;
use App\Form\TorrentsType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TorrentsController
 * @package App\Controller
 *
 * @Route("/torrents")
 */
class TorrentController extends AbstractController
{
    /**
     * @Route("/", name="torrents_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $data =  $this->getDoctrine()->getRepository(Torrent::class)->findBy([], ['date' => 'DESC']);

        $torrents = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            15
        );

        return $this->render('torrents/index.html.twig', [
            'torrents' => $torrents,
        ]);
    }

    /**
     * @Route("/new", name="torrents_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
       $torrent = new Torrent();

        $form = $this->createForm(TorrentsType::class, $torrent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // UPLOAD IMAGE
            $uploadedFile = $form['image']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/images/torrents';

                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $torrent->setImage($newFilename);
            }

            // UPLOAD TORRENT FILE
            $uploadedFileTorrent = $form['torrentFile']->getData();

            if ($uploadedFileTorrent) {

                // Set media torrent file size
                //$torrent->setSize("822145787");
                // Set media torrent hash
                //$torrent->setHash("2a8975412f3241r56t987f4d5f4df4897");

                $fd = fopen($uploadedFileTorrent, "rb");
                $length = filesize($uploadedFileTorrent);
                if($length) {
                    $allTorrent = fread($fd, $length);

                    function BDecode($wholefile): array
                    {
                        $decoder = new BDecode;
                        $return = $decoder->decodeEntry($wholefile);
                        return $return[0];
                    }

                    function BEncode($array): string
                    {
                        $string = '';
                        $encoder = new BEncode;
                        $encoder->decideEncode($array, $string);
                        return $string;
                    }

                    $array = BDecode($allTorrent);
                    $hash = sha1(BEncode($array["info"]));
                    $torrent->setHash($hash);
                    fclose($fd);
                }

                if (isset($array["info"]) && $array["info"]) {
                    $upfile = $array["info"];
                } else {
                    $upfile = 0;
                }

                if (isset($upfile["length"])) {
                    $size = (float)($upfile["length"]);
                    $torrent->setSize($size);
                }
                else if (isset($upfile["files"])) {
                    // multi-files torrent
                    $size = 0;
                    foreach ($upfile["files"] as $file) {
                        $size += (float)($file["length"]);
                        $torrent->setSize($size);
                    }
                }
                else {
                    $size = 0;
                    $torrent->setSize($size);
                }

                // Vérif de l'URL d'announce
                $announce = trim($array["announce"]);
                $announceUrl = "http://www.ft4a.fr:55555/announce";
                if($array['announce'] != $announceUrl) {
                    $error[] = 'Vous n\'avez pas fournit la bonne adresse d\'announce dans votre torrent : l\'url d\'announce doit etre '.$announceUrl;
                }


                // Upload du fichier .torrent
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/torrentfiles';

                $originalFilename = pathinfo($uploadedFileTorrent->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFileTorrent->guessExtension();

                $uploadedFileTorrent->move(
                    $destination,
                    $newFilename
                );
                $torrent->setTorrentFile($newFilename);
            }

            $entityManager = $this->getDoctrine()->getManager();

            // Set the datetime
            $torrent->setDate(new \DateTime());

            // Set the connected member
            $torrent->setAuthor($this->getUser());

            // Set number of views to 1 when creating torrent
            $torrent->setViews('1');

            $entityManager->persist($torrent);
            $entityManager->flush();

            return $this->redirectToRoute('torrents_index');
        }

        return $this->render('torrents/new.html.twig', [
            'torrent' => $torrent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="torrents_show", methods={"GET", "POST"})
     * @param Torrent $torrent
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function show(Torrent $torrent, Request $request, EntityManagerInterface $manager): Response
    {
        // Views: +1 for each visit
        $read = $torrent->getViews() + 1;
        $torrent->setViews($read);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($torrent);
        $entityManager->flush();

        // Commentaires
        $comment = new Comment();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                ->setTorrent($torrent)
                // ON récupère l'utilisateur connecté
            ->setAuthor($this->getUser());

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('torrents_show', [
                'slug' =>$torrent->getSlug()
            ]);
        }

        return $this->render('torrents/show.html.twig', [
            'torrent' => $torrent,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="torrents_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Torrent $torrent
     * @return Response
     */
    public function edit(Request $request, Torrent $torrent): Response
    {
        $form = $this->createForm(TorrentsType::class, $torrent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('torrents_index');
        }

        return $this->render('torrents/edit.html.twig', [
            'torrent' => $torrent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="torrents_delete", methods={"DELETE"})
     * @param Request $request
     * @param Torrent $torrent
     * @return Response
     */
    public function delete(Request $request, Torrent $torrent): Response
    {
        // On supprime l'image du torrent qui est supprimé
        $image = $torrent->getImage();

        if($image) {
            $nomImage = $this->getParameter("torrent_image_directory") . '/' . $image;

            // On vérifie si l'image existe et on supprime l'image
            if(file_exists($nomImage)) {
                unlink($nomImage);
            }
        }

        // On supprime aussi le fichier .torrent du torrent qui est supprimé
        $fileTorrent = $torrent->getTorrentFile();

        if($fileTorrent) {
            $nomFile = $this->getParameter("torrent_file_directory") . '/' . $fileTorrent;

            // On vérifie si l'image existe et on supprime l'image
            if(file_exists($nomFile)) {
                unlink($nomFile);
            }
        }

        // On supprime les infos du torrent dans la base
        if ($this->isCsrfTokenValid('delete'.$torrent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($torrent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('torrents_index');
    }
}
