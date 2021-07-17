<?php

namespace App\Repository;

use App\Entity\Breeds;
use App\Entity\Animals;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Breeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Breeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Breeds[]    findAll()
 * @method Breeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Breeds::class, Animals::class);
    }

    public function getAgeMoyenne($country, $animals){
        

        $query = $this->createQueryBuilder('b')
            ->select('AVG(b.ageBreed)')
            ->innerJoin('b.idAnimals', 'a')
            ->innerJoin('a.idCountry', 'c')
            ->where("a.id = :animalId")
            ->andWhere('c.id = :countryId')
            ->setParameter('animalId', $animals)
            ->setParameter('countryId', $country)
            ->getQuery()
            ->getResult()
        ;
        
        return $query ;

    

    }

    // /**
    //  * @return Breeds[] Returns an array of Breeds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Breeds
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
