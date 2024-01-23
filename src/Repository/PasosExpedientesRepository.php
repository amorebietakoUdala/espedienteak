<?php

namespace App\Repository;

use App\Entity\PasosExpedientes;
use App\Entity\RegExpedientes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PasosExpedientes>
 *
 * @method PasosExpedientes|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasosExpedientes|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasosExpedientes[]    findAll()
 * @method PasosExpedientes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasosExpedientesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasosExpedientes::class);
    }

    public function add(PasosExpedientes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PasosExpedientes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getPasosExpendienteOrdered(RegExpedientes $regExpedientes) {
        $result = $this->findBy(['expediente' => $regExpedientes], [ 'paso' => 'ASC']);
        return $result;
    }
}
