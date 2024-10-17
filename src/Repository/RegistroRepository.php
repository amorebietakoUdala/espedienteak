<?php

namespace App\Repository;

use App\Entity\Registro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Registro>
 *
 * @method Registro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registro[]    findAll()
 * @method Registro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registro::class);
    }

    public function add(Registro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Registro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Registro[] Returns an array of Registro objects
    */
    public function findByCriteria($criteria, $orderBy = null, $limit = null, $offset = null): array
    {
        //dd($criteria);
        $criteriaLikeKeys = [
            'descripcion' => null,
        ];
        $criteriaLike = $criteriaAnd = null;
        if ( $criteria !== null ) {
            $criteriaLike = array_intersect_key($criteria,$criteriaLikeKeys);
            $criteriaAnd = array_diff_key($criteria,$criteriaLikeKeys);
        }
        $qb = $this->createQueryBuilder('r');

        if ( $criteriaAnd ) {
            foreach ( $criteriaAnd as $field => $filter ) {
                if ( !empty($criteria[$field])) {
                    $qb->andWhere('r.'.$field.' = :'.$field)
                        ->setParameter($field, $filter);
                }
            }
        }
        if ( $criteriaLike ) {
            foreach ( $criteriaLike as $field => $filtroa ) {
                if ( !empty($criteria[$field])) {
                    $qb->andWhere('r.'.$field.' LIKE :'.$field)
                    ->setParameter($field, '%'.$filtroa.'%');
                }
            }
        }
        $qb->orderBy('r.ordenEntradaSalida', 'DESC');
        $qb->setMaxResults($limit);
        $result = $qb->getQuery()->getResult();
        return $result;
    }

}
