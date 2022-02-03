<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu")
 */
class MenuController extends AbstractController
{
    /**
     * @Route("/", name="menu_index", methods={"GET"})
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="menu_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $menu = new Menu();
        $name = $menu->getName();

        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $menu = $form->getData();
            $entityManager->persist($menu);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le menu ' . $name . 'a bien été ajouté.'
            );
            return $this->redirectToRoute('menu_index');
        }

        return $this->renderForm('menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="menu_show", methods={"GET"})
     */
    public function show(Menu $menu, ManagerRegistry $managerRegistry): Response
    {
        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="menu_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Menu $menu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="menu_delete")
     */
    public function delete(ManagerRegistry $managerRegistry, int $id): Response
    {
        $entityManager = $managerRegistry->getManager();
        $menu = $entityManager->getRepository(Menu::class)->find($id);

        if (!$menu) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $name = $menu->getName();
        $entityManager->remove($menu);
        $entityManager->flush();
        $this->addFlash(
            'danger',
            'Le menu ' . $name . ' a bien été supprimé!'
        );

        return $this->redirectToRoute('menu_index', [
            'id' => $menu->getID()
        ]);
    }
}
