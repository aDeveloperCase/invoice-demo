<?php

namespace App\Repository;

use App\Entity\InvoiceDetail;
use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InvoiceDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceDetail[]    findAll()
 * @method InvoiceDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceDetailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InvoiceDetail::class);
    }

    // This shold be automatically done by cascading with doctrine?
    public function setInvoiceAndUpdate(Invoice $invoice) {

    }

    // /**
    //  * @return InvoiceDetail[] Returns an array of InvoiceDetail objects
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
    public function findOneBySomeField($value): ?InvoiceDetail
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
