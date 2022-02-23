<?php

namespace App\Repository;

use App\Entity\Mission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mission[]    findAll()
 * @method Mission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }

    // Paging
    public function findMissionPaginer(int $page = 1, int $limit = 5): array
    {
        return $this->findBy([], [], $limit, ($page - 1) * 5);
    }

    public function findMissionPaginerCount(): int
    {
        $mission = $this->findAll();
        return $this->count([]);
    }

    // Method for search engine
    public function searchMission(string $search): array
    {
        $qb = $this->createQueryBuilder('mission');
        $query = $qb->select('mission')
            ->where('mission.title LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery();

        return $query->getResult();
    }
}