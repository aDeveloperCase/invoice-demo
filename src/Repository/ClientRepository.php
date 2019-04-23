<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('c')
            ->addOrderBy('c.firstName', 'ASC')
            ->addOrderBy('c.lastName', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFilter($word): array
    {
        if (!$word)
            return $this->findAllOrdered();

        return $this->createQueryBuilder('c')
            ->where('c.firstName LIKE :word')
            ->orWhere('c.lastName LIKE :word')
            ->addOrderBy('c.firstName', 'ASC')
            ->addOrderBy('c.lastName', 'ASC')
            ->setParameter('word', '%' . $word . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
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
    public function findOneBySomeField($value): ?Client
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
