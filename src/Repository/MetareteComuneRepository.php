<?php

namespace Metarete\ComuniBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Metarete\ComuniBundle\Entity\MetareteComune;

/**
 * @extends ServiceEntityRepository<Comune>
 */
class MetareteComuneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetareteComune::class);
    }
}
