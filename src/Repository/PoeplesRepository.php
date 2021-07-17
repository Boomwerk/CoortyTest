<?php

namespace App\Repository;

use App\Entity\Poeples;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Poeples|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poeples|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poeples[]    findAll()
 * @method Poeples[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoeplesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poeples::class);
    }


    public function getTop($idCountry, $idAnimals){

        $query = $this->createQueryBuilder('p')
        ->select('b.nameBreed, p.numberPeople')
        ->innerJoin('p.idBreeds', 'b')
        ->innerJoin('p.idCountry', 'c')
        ->innerJoin('p.idAnimals', 'a')
        ->where("c.id = :countryId")
        ->andWhere('a.id = :animalsId')
        ->andWhere('b.sizeBreed > 50')
        ->setParameter('countryId', $idCountry)
        ->setParameter('animalsId', $idAnimals)
        ->orderBy('p.numberPeople', "DESC")
        ->getQuery()
        ->getResult()
        ;

        return $query;
    }
    
    // /**
    //  * @return Poeples[] Returns an array of Poeples objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Poeples
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
