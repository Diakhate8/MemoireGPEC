<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



/**
 * @Route("/api")
 */
class StatusController extends AbstractController
{
    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/status/{id}", name="status", methods={"Get"})
     */
    public function onStatus($id, UserRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(User::class)
        $user = $repo->find($id);
        $mode = '';
        if($user->getIsActive()===true){
            $mode = 'desactive';
            $user->setIsActive(false);
        }else{
            $mode = 'active';
            $user->setIsActive(true);
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        $data= [
            "status" => 200,
            "message" => $user->getUsername()." est ".$mode 
        ];
        return $this->json($data, 200);
    }


    
}
