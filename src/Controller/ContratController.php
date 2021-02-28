<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Commande;
use App\Entity\Personne;
use App\Utule\Modalites;
use App\Utule\FormatedDate;
use App\Utule\NumberToWords;
use App\Utule\ModaliteString;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;
use ApiPlatform\Core\GraphQl\Resolver\Stage\DeserializeStage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/api")
 */
class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    public function index()
    {
        return $this->render('contrat/index.html.twig', [
            'controller_name' => 'ContratController',
        ]);
    }


    /**
     * @IsGranted({"ROLE_ADMIN_SYSTEM", "ROLE_ADMIN"}, statusCode=404,
     * message=" Access refuser vous n'etes pas Administrateur")
     * @Route("/addcontrat", name="contrat.add", methods={"Post"})
     */
    public function addClient( Request $request, EntityManagerInterface $em,Modalites $modals,
    FormatedDate $formDate,ModaliteString $modS,NumberToWords $toWords, SerializerInterface $serializerInt)
    {
        $userOnline = $this->getUser();
        // dd($userOnline);
        $jsonRecu = $request->getContent();
        $donneeRecu = json_decode($jsonRecu); 
        $dataC=$donneeRecu->client;       
        // dd($dataC->numero);
        $day = new \DateTime(); $jour =$day->format('d/m/Y');
        $devise = "FCFA"; $br="\n"; $montAVerser=0; $mesArticles=" ";$prodsPreambule="";

            // print_r($toWords->inWords($number));die();

        // Get Datas Client
            $numeroC = $dataC->numero; $prenomC = $dataC->prenom ; $nomC = $dataC->nom;
            $lieuNaissC = $dataC->lieuNaiss ; $adresseC= $dataC->adresse;
            $telephoneC = $dataC->telephone; $cniC = $dataC->cni; 
            $dateNaissC = $formDate->formaterDate($dataC->dateNaiss);
            $dateDCniC = $formDate->formaterDate($dataC->dateDCni);
            $dateECniC = $formDate->formaterDate($dataC->dateECni);
            $domicileC = $dataC->domicile;     
            // dd($dateNaissC)       ;
        // End Get Datas Client       
        // // Set Datas Client
            $client = new Client();        
            $client->setNumClient($numeroC)
                    ->setPrenom($prenomC)
                    ->setNom($nomC)
                    ->setDateNaiss($dateNaissC)
                    ->setLieuNaiss($lieuNaissC);
            $client->setCni($cniC)
                ->setDateDCni($dateDCniC)
                ->setDateECni($dateECniC )
                ->setDomicile($domicileC)
                ->setTelephone($telephoneC);
            $client->setAdresse($adresseC);
            // dd($client);
            $em->persist($client);
        // // End Set Datas Client
        // // Get Datas Subroge
            $dataS=$donneeRecu->subroge;
            $prenomS= $dataS->prenom; $nomS = $dataS->nom;
            $lieuNaissS = $dataS->lieuNaiss; $telephoneS = $dataS->telephone;
            $cniS = $dataS->cni; $domicileS = $dataS->domicile;
            $dateNaissS = $dataS->dateNaiss;
            $dateDCniS = $dataS->dateDCni;
            $dateECniS = $dataS->dateECni;
        // End Get Datas Subroge
        // Get datas Produit
            $libele = $donneeRecu->libele;  $acompte = $donneeRecu->acompte;        
            $articles= $donneeRecu->articles;   $nbrEcheanciers= $donneeRecu->nbrEcheanciers;  
        //Get and set commande  articles 
            $facture = new Facture();
            $ref=rand(10,9999999)."$numeroC";//var_dump($ref);die();
                // Get and Set datas Commande[{}]
                for($i=0;$i<count($articles);$i++){
                    $commande=new Commande();
                    $commande->setDesignation($articles[$i]->article)
                            ->setPrixUnitaire($articles[$i]->prixU)
                            ->setNombre($articles[$i]->nbr)
                            ->setPrixTotal($articles[$i]->prixU*$articles[$i]->nbr)
                            ->setFacture($facture);
                    $em->persist($commande); 
                    $mesArticles.=$toWords->inWords($articles[$i]->nbr)." ".$articles[$i]->article." ,"; //nom et nombre
                    $prodsPreambule.=$articles[$i]->article." \n";                   // articles texte avec retour a la ligne
                    $montAVerser+=$articles[$i]->prixU*$articles[$i]->nbr;          // prix total des articles
                    $restAPayer=$montAVerser-$acompte;
                }
                // dd($commande);
                // End Get and Set datas Commande
            $facture->setNumFacture($numeroC)
                    ->setMontAVerser($montAVerser)
                    ->setAcompte($acompte)
                    ->setMontVerse($acompte)
                    ->setResteAPayer($restAPayer);
            $em->persist($facture);        
                    // dd($facture);
        // Set datas Facture    

        // recuperation du contrat proformat
            $contratRepo=$this->getDoctrine()->getRepository(Contrat::class);
            $entityContrat = $contratRepo->findOneBy(array("reference"=>"bokokomarket"));
        // Ajout new contrat        
            $contrat = new Contrat();
            $contrat->setClient($client)
                    ->setCreatedAt($day)
                    ->setUserCreateur($userOnline)
                    ->setReference($ref)
                    ->setNumContrat($numeroC);
        // Affectation
            $contrat->addFacture($facture);
            $facture->setContrat($contrat);
        // End affectation 
        // Infos client         
            $contrat->setLibele($entityContrat->getLibele().' '.$libele)
                    ->setIntitule($entityContrat->getIntitule()."\nMonsieur(Madame) $dataC->prenom $dataC->nom né(e) le $dataC->dateNaiss à $dataC->lieuNaiss titulaire de la CNI(du Passeport) N° $dataC->cni, delivrée le $dataC->dateDCni, valable jusqu'au $dataC->dateECni, et demeurant à $dataC->domicile; ci-après désigné(e) « Client/Acheteur »\nD’autres part" )
                    ->setArrete($entityContrat->getArrete());
            $contrat->setPreambule($entityContrat->getPreambule()."\n".$prodsPreambule );
        // Objet du contrat                
            $contrat->setArticle1($entityContrat->getArticle1().$mesArticles.
            "moyennant paiement de la somme totale de ".$toWords->inWords($montAVerser)." ($montAVerser) F CFA");        
        // Mise a disposition            
            $contrat->setArticle2($entityContrat->getArticle2());
        // Modalites de paiement            
            $scContrat=$modS->modStringSix($donneeRecu);/*convertion date to string */
            $contrat->setArticle3($entityContrat->getArticle3()."\nLe client versera un acompte de ".$toWords->inWords($acompte).
            "($acompte) FCFA à la date de livraison Le montant restant, à savoir les ".$toWords->inWords($restAPayer).
            "($restAPayer) F CFA sera versé en $nbrEcheanciers échéanciers".$br. 
                         $scContrat['premierE'].
                         $scContrat['deuxiemeE'].
                         $scContrat['troisiemeE']. 
                         $scContrat['quatriemeE']. 
                         $scContrat['cinquiemeE']. 
                         $scContrat['sixiemeE'] .
                         $scContrat['septiemeE'].
                         $scContrat['huitiemeE']. 
                         $scContrat['neuviemeE']. 
                         $scContrat['dixiemeE']. 
                         $scContrat['onziemeE'].
                         $scContrat['douziemeE'].
     
                "\nLe premier paiement prendra effet le $donneeRecu->premierE Le vendeur déclare accepter les moyens de paiement suivant :\nVirement bancaire\nDépôt direct en espèces\nPaiement électronique transfert d’argent (Wari, Orange money,Wave ,Wafacash, Cofina, Moneygram), les frais de transferts sont à la charge du client.\nPaiement à l’agence"
            );
        // End Modalites de paiement  
            $contrat->setArticle4($entityContrat->getArticle4());
            $contrat->setArticle5($entityContrat->getArticle5());
        // Infos du garant
            $contrat->setArticle6($entityContrat->getArticle6().
            "\nEn cas de non-paiement Monsieur (Madame) $dataS->prenom $dataS->nom né(e) le $dataS->dateNaiss à $dataS->lieuNaiss, titulaire de la CNI (du Passeport) N0 $dataS->cni, en date du $dataS->dateDCni et valable jusqu’au $dataS->dateECni et demeurant à $dataS->domicile s’engage à se substituer au client pour payer ladite somme au principal et tous les frais et pénalités qui y sont greffés")
        //Obligation
                    ->setArticle7($entityContrat->getArticle7())
                    ->setArticle8($entityContrat->getArticle8())
                    ->setArticle9($entityContrat->getArticle9())
                    ->setArticle10($entityContrat->getArticle10().
        "Fait à Dakar le $jour, en deux exemplaires, chaque partie reconnaissant avoir reçu le tien.
         Signature précédée de la mention « lu et approuvé »");
        // Set datas Contrat
        // dd($scContrat['deuxiemeE']);ok
           
        // Infos client
        $em->persist($contrat);
        // dd($contrat);

        $em->flush();       
        // $data= [
        //     "status" => 200,
        //     "message" => "contrat cree avec succé"
        // ];
        // return $this->json($data, 200);

        $dataContrat=$serializerInt->serialize($contrat,'json');
        return new Response($dataContrat, 201,['content-Type'=> 'application/json']);
    }
}
