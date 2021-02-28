<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Contrat;
use App\Utule\FormatedDate;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/api")
 */
class UserController extends AbstractController
{ 
    /**
     * @IsGranted({"ROLE_ADMIN","ROLE_ADMIN_SYSTEM","ROLE_PARTENAIRE", "ROLE_ADMIN_PARTENAIRE"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/user", name="user.show", methods={"Get"})
     */
    public function showUser(UserRepository $userRepo, RoleRepository $roleRepo,Security $securite ,
                             SerializerInterface $serializer)
    {   //tab roles
        $user = $this->getUser();
        $roleUser = $user->getRoles()[0];
        //dd($roleUser);ok
       // dd($idP);ok
        if($roleUser==='ROLE_ADMIN_SYSTEM') { $users = $userRepo->adminsysShowUsers();}
        elseif($roleUser==='ROLE_ADMIN'){$users = $userRepo->adminShowUser();}
        elseif($roleUser === 'ROLE_CAISSIER'){$users = $userRepo->assistantShowUsers();}
        else{return new Response('Vous n\'etes pas autoriser a lister des ulisateurs', 403, ['Content-Type' => 'application/json']);}
       // $data = $serializer->serialize($users,'json');ok
        //return new Response($data , 200, ['Content-Type'=>'application/json']);ok
        return $this->json($users , 200, [],['groups'=> 'post:read']);

    }

    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/users", name="user.new", methods={"Post"})
     */
    public function addUser(Request $request,FormatedDate $formDate, SerializerInterface $serializerInt,
    EntityManagerInterface $em, UserPasswordEncoderInterface $userPasswordEncoder    ) 
    { 
        $user = $this->getUser();
        $roleUser = $user->getRoles()[0];
        // dd($userOnline);ok
        $jsonRecu = $request->getContent();
        $donneeRecu = json_decode($jsonRecu); 
        // dd($donneeRecu);
        $jour =new \DateTime();
        
        $user = new User();
        $donneeRecu = json_decode($request->getContent());
        $roleRepo=$this->getDoctrine()->getRepository(Role::class);
        $role = $roleRepo->findOneBy(array("id"=>$donneeRecu->role ));
        if($roleUser==='ROLE_ADMIN_SYSTEM' && $role->getLibelle()==='ROLE_ADMIN_SYSTEM'){
            $data= ["status" => 403, 
            "message" => " Acces refuser "];
            return new JsonResponse($data, 403);
        } 
        // dd($role);
        $dateNaiss = $formDate->formaterDate($donneeRecu->dateNaiss);
        $lieuNaiss= $donneeRecu->lieuNaiss;
        //if($this->getUser()->getRoles())
        $user->setRole($role);
        $user->setPrenom($donneeRecu->prenom);
        $user->setNom($donneeRecu->nom)
            ->setDateNaiss($dateNaiss)
            ->setLieuNaiss($lieuNaiss)
            ->setTelephone(trim($donneeRecu->telephone));
        $user->setEmail(trim($donneeRecu->email));
        $user->setUsername(trim($donneeRecu->username))
                ->setPassword($userPasswordEncoder->encodePassword($user, $donneeRecu->password)) 
                ->setRole($role);          
        // dd($user);
        $em->persist($user);


        $em->flush();
        $data= ["status" => 201, "message" => " Utulisateur $donneeRecu->username Cree avec succes"];
        return new JsonResponse($data, 201);


      
    }



}

