<?php

namespace App\Controller;

use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


/**
 * @Route("/api")
 */
class ShowContratController extends AbstractController
{
    /**
     * @Route("/show/contrat", name="show_contrat")
     */
    public function index()
    {
        return $this->render('show_contrat/index.html.twig', [
            'controller_name' => 'ShowContratController',
        ]);
    }

    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/showventes", name="ventes.show", methods={"Get"})
     */
    public function showVente( Request $request, EntityManagerInterface $em,
    ContratRepository $contratRepo, SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser();
        $idUser = $userOnline->getId();
        // $vente=$contratRepo->findAll();
        // $vente=$contratRepo->AdminSysFindVentes();
        $vente=$contratRepo->AdminFindVentes($idUser);
        // dd($vente);
        $ventes=$dataContrat=$serializerInt->serialize($vente,'json');
        return $this->json($ventes, 200,['content-Type'=> 'application/json']);
    }
}
