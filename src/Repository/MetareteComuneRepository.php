<?php

namespace Metarete\ComuniBundle\Repository;

use Metarete\ComuniBundle\Entity\MetareteComune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
