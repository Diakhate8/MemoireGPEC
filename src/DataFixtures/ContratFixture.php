<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Contrat;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContratFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $jour =new \DateTime();
        $contrat= new Contrat();
        $contrat->setNumContrat("bm1")
                ->setCreatedAt($jour)
                ->setReference("bokokomarket");

        $contrat->setLibele("contrat proformat");
        $contrat->setIntitule(
        "Entre\nLa société Bokoko Market ayant son siège à la Cité Avion, Ouakam, Dakar, Sénégal représentée par Monsieur Pape Ndiankou GUEYE, Directeur de ladite ; ci-après désignée « Vendeur »\nD’une part,\nEt");
        $contrat->setArrete("Il a été arrêté et convenu ce qui suit, entre les deux parties : ");
        $contrat->setPreambule(
        "PREAMBULE:
1_ « Le vendeur » est une société spécialisée dans la vente à tempérament de produits électroménagers, des ordinateurs, des smartphones et de meubliers etc. Elle permet à ses clients de faire des paiements fractionnés en plusieurs versements échelonnés sur une certaine durée.
2_ « Le Client/Acheteur » est quant à lui une personne physique.
3_ Les parties déclarent ne pas être concerné par une procédure de redressement ou liquidation judiciaire ou procédure similaire, ni en état de tutelle, curatelle mise sous sauvegarde de justice, ni d’interdiction de faire des actes de disposition.
4_Le présent accord a pour but la vente de :");
        $contrat->setArticle1(
        "OBJET DU CONTRAT
Suivant les clauses et conditions du présent contrat, « le vendeur » consent à livrer au « client » qui l’accepte expressément, ");
        $contrat->setArticle2(
        "ARTICLE 2-MISE A DISPOSITION DES PRODUITS
Le vendeur s’engage à lui remettre les biens mobiliers au plus tard dans les cinq (5) jours ouvrés.
En cas d’impossibilité, il s’engage à prévenir l’acheteur dans les meilleurs délais.");

        $contrat->setArticle3(
        "ARTICLE 3-MODALITE DE PAIEMENT");

        $contrat->setArticle4(
        "ARTICLE 4 - INTERETS DE RETARDS
Tout retard de remboursement entraine la majoration de dix mille (10000) F CFA par jour sur la somme exigible, jusqu’à complet paiement, et ce, sans qu’il y ait pour le vendeur une mise en demeure préalablement adresser au client.");

        $contrat->setArticle5(
        "ARTICLE 5-DUREE
Le présent contrat prendra effet à compter de la date de signature et prendra fin à la date du dernier échéancier citée ci-dessus
Le client peut toutefois anticiper la fin du contrat, à tout moment, en versant le solde de tout compte.
        ");
        
        $contrat->setArticle6(
        "ARTICLE 6 - GARANTIES");
        
        $contrat->setArticle7(
        "ARTICLE 7 - OBLIGATION DES PARTIES
En sus de livrer les produits en bon état et dans le délai imparti, le vendeur s’engage à informer l’acheteur des caractéristiques essentielles du bien vendu. Il s’oblige à lui communiquer toutes informations et conseils utiles à l’utilisation du bien.
Le client s’oblige quant à lui à payer le prix convenu ci-dessus dans les délais prévus par le présent contrat.
Il a également l’obligation de fournir au vendeur la pièce d’identité sénégalaise et le numéro de téléphone de son subrogé.
        ");
        
        $contrat->setArticle8(
        "ARTICLE 8 - RESOLUTION DU CONTRAT
En cas de non-respect des engagements par le client et le subrogé, les biens seront restitués à l’entreprise.\nSi la vente ne permet pas de récupérer la totalité du montant, le vendeur se réserve le droit de poursuivre le client et le subrogé afin de recouvrer la somme restante.
        ");
        
        $contrat->setArticle9(
        "ARTICLE 9 - CONTENTIEUX ET JURIDICTIONS
Pour toute litige, différend ou réclamation née du présent contrat ou s’y rapportant (y compris sa conclusion, son interprétation, son exécutions résolution ou sa nullité, les parties feront de leur mieux pour un règlement à l’amiable. A défaut, les parties pourront saisir le Tribunal de Commerce Instance Hors Class de Dakar pour régler leur différend.
        ");
        $contrat->setArticle10("ARTICLE 10 - CLAUSE PARTICULIERE
Il est expressément convenu qu’en cas de litige, soumis ou non à l’appréciation des tribunaux compétents, les frais d’huissier, d’expertise et d’honoraires d’avocat, qui auraient été engagés et ce sur pièces justificatives, seront remboursés par la partie qui aurait perdu le procès.
        ");

        // dd($contrat);

        $manager->persist($contrat);

        $manager->flush();
    }
}
