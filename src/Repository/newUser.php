<?php

namespace App\Repository;


use App\Entity\NewUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewUser[]    findAll()
 * @method NewUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewUser::class);
    }

    // Custom query example: Find users by a specific role
    public function findByRole(string $role)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.roles LIKE :role')
            ->setParameter('role', '%'.$role.'%')
            ->getQuery()
            ->getResult();
    }



    // You can add other custom methods as needed


}