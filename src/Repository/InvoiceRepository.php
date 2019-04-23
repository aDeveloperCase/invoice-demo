<?php

namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Invoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invoice[]    findAll()
 * @method Invoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function findAllOrdered(): array
    {
        return $this->createQueryBuilder('i')
            ->addOrderBy('i.invoiceNumber', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByFilter($word): array
    {
        if (!$word) {
            return $this->findAllOrdered();
        }

        return $this->createQueryBuilder('i')
            ->leftJoin('i.client', 'c')
            ->leftJoin('i.invoiceDetail', 'd')
            ->where('c.firstName LIKE :word')
            ->orWhere('c.lastName LIKE :word')
            ->orWhere('d.description LIKE :word')
            ->setParameter('word', '%' . $word . '%')
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return Invoice[] Returns an array of Invoice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Invoice
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
