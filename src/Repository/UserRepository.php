<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function AdminsysShowUsers()
    {
        return $this->getEntityManager()
          ->createQuery('SELECT U.id ,U.username, U.password, U.prenom, U.nom,U.adresse,U.telephone, U.email , U.isActive ,R.libelle
        FROM App\Entity\User U , App\Entity\Role R
        WHERE U.role = R.id AND R.libelle IN (\'ROLE_ADMIN\',\'ROLE_CAISSIER\') '
            )
         ->getResult();
    }
    /**
     * @return User[] Returns an array of User objects
     */
    public function AdminShowUser()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT U.id ,U.username, U.password, U.prenom, U.nom,U.adresse,U.telephone, U.email , U.isActive ,R.libelle
        FROM App\Entity\User U , App\Entity\Role R
        WHERE U.role = R.id AND R.libelle IN (\'ROLE_CAISSIER\') '
            )
            ->getResult();
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function ShowPart()
    {
        return $this->getEntityManager()
                ->createQuery('SELECT U.id ,U.username, U.prenom, U.nom,U.adresse,U.telephone, U.email , U.isActive ,R.libelle, P.ninea, P.rc
        FROM App\Entity\User U , App\Entity\Role R, App\Entity\Partenaire P
        WHERE U.role = R.id AND U.partenaire = P.id
        AND R.libelle IN (\'ROLE_PARTENAIRE\') '
                )
                ->getResult();
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function AssistantShowUsers()
    {
        return $this->createQueryBuilder('u')
            ->Where('u.role = 4')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return User[] Returns an array of User objects
     */
    public function PShowUsers($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.partenaire = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return User[] Returns an array of User objects
     */
    public function AdminPShowUsers($idP)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT U.id, U.username, U.prenom, U.nom,  U.email , R.libelle , U.isActive , P.id
                 FROM  App\Entity\User U , App\Entity\Role R , App\Entity\Partenaire P
                 WHERE U.role = R.id AND  U.partenaire = P.id AND U.partenaire ='.$idP.'
                 AND R.libelle IN (\'ROLE_CAISSIER_PARTENAIRE\')'
                 )
            ->getResult();
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function pShowUsersN($idP)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT U.id, U.username, U.prenom, U.nom,  U.email , R.libelle , U.isActive, P.id
                 FROM  App\Entity\User U , App\Entity\Role R , App\Entity\Partenaire P, App\Entity\Affectation A 
                 WHERE U.role = R.id AND  U.partenaire = P.id AND U.partenaire ='.$idP.' 
                 AND R.libelle IN (\'ROLE_CAISSIER_PARTENAIRE\')'
            )
            ->getResult();
    }

}
