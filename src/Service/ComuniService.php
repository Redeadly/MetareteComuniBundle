<?php

namespace Metarete\ComuniBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class ComuniService
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}
    

    /**
     * Retrieves a list of distinct province abbreviations (siglaProvincia) from the MetareteComune entity.
     *
     * This method constructs a query using the entity manager to select distinct province abbreviations,
     * orders them in ascending order, and returns the result as an array of strings.
     *
     * @return array An array of distinct province abbreviations (siglaProvincia).
     */
    public function getProvinceList(): array
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('DISTINCT c.siglaProvincia')
            ->from('Metarete\ComuniBundle\Entity\MetareteComune', 'c')
            ->orderBy('c.siglaProvincia', 'ASC')
            ->getQuery();
        $result = $query->getResult();

        return array_map(fn($item) => $item['siglaProvincia'], $result);
    }

    /**
     * Retrieves a list of unique CAP (postal codes) from a given comune.
     *
     * This method queries the database to get a distinct list of CAPs associated with the specified comune.
     * The comune can be identified by its codice istat or its name.
     * The results are ordered in ascending order.
     *
     * @param string $comune The codice istat or name of the comune to filter the CAPs.
     * @return array An array of unique CAPs sorted in ascending order.
     */
    public function getCAPListFromComune(string $comune): array
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('DISTINCT c.cap')
            ->from('Metarete\ComuniBundle\Entity\MetareteComune', 'c')
            ->where('c.codiceIstat = :comune OR c.denominazioneIta = :comune')
            ->setParameter('comune', $comune)
            ->orderBy('c.cap', 'ASC')
            ->getQuery();
            $result = $query->getResult();
            
            return array_map(fn($item) => $item['cap'], $result);
    }
        
    /**
     * Retrieves a list of unique CAP (postal codes) from a given province.
     *
     * This method queries the database to get a distinct list of CAPs associated with the specified province.
     * The results are ordered in ascending order.
     *
     * @param string $provincia The province code to filter the CAPs.
     * @return array An array of unique CAPs sorted in ascending order.
     */
    public function getCAPListFromProvincia(string $provincia): array
    {
        $query = $this->entityManager->createQueryBuilder()
            ->select('DISTINCT c.cap')
            ->from('Metarete\ComuniBundle\Entity\MetareteComune', 'c')
            ->where('c.siglaProvincia = :provincia')
            ->setParameter('provincia', $provincia)
            ->orderBy('c.cap', 'ASC')
            ->getQuery();
        $result = $query->getResult();

        return array_map(fn($item) => $item['cap'], $result);
    }

}
