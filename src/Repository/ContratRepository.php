<?php

namespace App\Repository;

use App\Entity\Contrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Contrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contrat[]    findAll()
 * @method Contrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contrat::class);
    }


     // /**
    //  * @return Vente[] Returns an array of Vente objects
    //  */
    
    public function AdminSysfindVentes()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT U.username, C.id, C.prenom, C.nom, Co.numContrat, Co.reference, F
                FROM  App\Entity\User U, App\Entity\Client C, App\Entity\Contrat Co, App\Entity\Facture F 
                WHERE C.id = Co.client AND F.contrat = Co.id 
            ')
            ->getResult();
    }
    
    /**
     * @return Vente[] Returns an array of Vente objects
     */
    public function AdminFindVentes($idUser)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT  U.username, C.id, C.prenom, C.nom, Co.numContrat, Co.reference, F
                FROM  App\Entity\User U, App\Entity\Client C, App\Entity\Contrat Co, App\Entity\Facture F 
                WHERE C.id = Co.client AND F.contrat = Co.id 
                    AND Co.userCreateur = '.$idUser.'
            ')
            ->getResult();
    } 

    // /**
    //  * @return Contrat[] Returns an array of Contrat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contrat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
