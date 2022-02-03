<?php

namespace App\Controller;

use App\Entity\Miamlist;
use App\Form\MiamlistType;
use App\Repository\MiamlistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/miamlist")
 */
class MiamlistController extends AbstractController
{
    /**
     * @Route("/", name="miamlist_index", methods={"GET"})
     */
    public function index(MiamlistRepository $miamlistRepository): Response
    {
        return $this->render('miamlist/index.html.twig', [
            'miamlists' => $miamlistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="miamlist_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $miamlist = new Miamlist();
        $name = $miamlist->getName();

        $form = $this->createForm(MiamlistType::class, $miamlist);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $miamlist = $form->getData();
            $entityManager->persist($miamlist);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'La liste ' . $name . ' a bien été ajouté.'
            );

            return $this->redirectToRoute('miamlist_index');
        }

        return $this->renderForm('miamlist/new.html.twig', [
            'miamlist' => $miamlist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="miamlist_show", methods={"GET"})
     */
    public function show(Miamlist $miamlist): Response
    {
        return $this->render('miamlist/show.html.twig', [
            'miamlist' => $miamlist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="miamlist_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Miamlist $miamlist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MiamlistType::class, $miamlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('miamlist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('miamlist/edit.html.twig', [
            'miamlist' => $miamlist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="miamlist_delete")
     */
    public function delete(ManagerRegistry $managerRegistry, int $id): Response
    {
        $entityManager = $managerRegistry->getManager();
        $miamlist = $entityManager->getRepository(Miamlist::class)->find($id);

        if (!$miamlist) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $name = $miamlist->getName();
        $entityManager->remove($miamlist);
        $entityManager->flush();
        $this->addFlash(
            'danger',
            'La Miamlist ' . $name . ' a bien été supprimé!'
        );

        return $this->redirectToRoute('miamlist_index', [
            'id' => $miamlist->getID(),
        ]);
    }
}
