<?php

namespace App\Repository;

use App\Entity\Table;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Table|null find($id, $lockMode = null, $lockVersion = null)
 * @method Table|null findOneBy(array $criteria, array $orderBy = null)
 * @method Table[]    findAll()
 * @method Table[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Table::class);
    }

    /**
     * Récupère toutes les tables
     *
     * @return Table[]
     */
    public function findAllTables()
    {
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère une table par son id
     *
     * @param int $id
     * @return Table|null
     */
    public function findTableById($id)
    {
        return $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Récupère une table par son nom
     *
     * @param string $name
     * @return Table|null
     */
    public function findTableByName($name)
    {
        return $this->createQueryBuilder('t')
            ->where('t.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Récupère toutes les tables qui ont des réservations
     *
     * @return Table[]
     */
    public function findTablesAvecReservations()
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.reservations', 'r')
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère toutes les tables qui n'ont pas de réservations
     *
     * @return Table[]
     */
    public function findTablesSansReservations()
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.reservations', 'r')
            ->where('r.id IS NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * Compte le nombre de tables
     *
     * @return int
     */
    public function countTables()
    {
        return $this->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}