<?php

namespace App\Repository;

use App\Entity\RegExpedientes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RegExpedientes>
 *
 * @method RegExpedientes|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegExpedientes|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegExpedientes[]    findAll()
 * @method RegExpedientes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegExpedientesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegExpedientes::class);
    }

    public function add(RegExpedientes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RegExpedientes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Movement[] Returns an array of Movement objects
    */
    public function findByCriteria($criteria, $orderBy = null, $limit = null, $offset = null): array
    {
        $criteriaLikeKeys = [
            'descripcion' => null,
            'solicitante' => null,
        ];
        $criteriaLike = $criteriaAnd = null;
        if ( $criteria !== null ) {
            $criteriaLike = array_intersect_key($criteria,$criteriaLikeKeys);
            $criteriaAnd = array_diff_key($criteria,$criteriaLikeKeys);
        }
        $from = $criteriaAnd['fechaInicio'] ?? null;
        unset($criteriaAnd['fechaInicio']);
        $to = $criteriaAnd['fechaFin'] ?? null;
        unset($criteriaAnd['fechaFin']);
        $qb = $this->createQueryBuilder('m');

        if ( $criteriaAnd ) {
            foreach ( $criteriaAnd as $field => $filter ) {
                if ( !empty($criteria[$field])) {
                    $qb->andWhere('m.'.$field.' = :'.$field)
                        ->setParameter($field, $filter);
                }
            }
        }
        if ( $criteriaLike ) {
            foreach ( $criteriaLike as $field => $filtroa ) {
                if ( !empty($criteria[$field])) {
                    $qb->andWhere('m.'.$field.' LIKE :'.$field)
                    ->setParameter($field, '%'.$filtroa.'%');
                }
            }
        }
        if ($from) {
            $qb->andWhere('m.fechaentrada >= :fechaInicio')
            ->setParameter('fechaInicio', $from);
        }
        if ($to) {
            $qb->andWhere('m.fechaentrada <= :fechaFin')
            ->setParameter('fechaFin', $to);
        }
        $qb->orderBy('m.id', 'DESC');
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

}
