<?php

namespace App\Repository;

use App\Entity\Table;
use App\Entity\TableOrder;
use App\Enums\TableOrderStatus;
use App\Enums\TableStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TableOrder>
 */
class TableOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableOrder::class);
    }

    public function findOngoingByTable(Table $table)
    {
        return $this->createQueryBuilder('table_order')
            ->select('table_order')
            ->join('table_order.occupiedTable', 'occupied_table')
            ->where('occupied_table = :table')
            ->andWhere('table_order.status = :table_order_status')
            ->andWhere('occupied_table.status = :table_status')
            ->setParameter('table', $table)
            ->setParameter('table_order_status', TableOrderStatus::ONGOING)
            ->setParameter('table_status', TableStatus::OCCUPIED)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

    }

//    /**
//     * @return TableOrder[] Returns an array of TableOrder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TableOrder
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
