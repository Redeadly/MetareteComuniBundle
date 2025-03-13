<?php

namespace Metarete\ComuniBundle\Command;

use Metarete\ComuniBundle\Entity\MetareteComune;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'metarete:comuni:load',
    description: 'Load comuni data from a JSON file into the database',
)]
class MetareteComuniLoadCommand extends Command
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Path to the JSON file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = $input->getArgument('file');

        if (!file_exists($filePath)) {
            $io->error('File not found: ' . $filePath);
            return Command::FAILURE;
        }

        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $io->error('Invalid JSON data');
            return Command::FAILURE;
        }

        foreach ($data as $item) {
            $comune = new MetareteComune();
            $comune->setCodiceIstat($item['codice_istat']);
            $comune->setDenominazioneItaAltra($item['denominazione_ita_altra']);
            $comune->setDenominazioneIta($item['denominazione_ita']);
            $comune->setDenominazioneAltra($item['denominazione_altra']);
            $comune->setCap($item['cap']);
            $comune->setSiglaProvincia($item['sigla_provincia']);
            $comune->setDenominazioneProvincia($item['denominazione_provincia']);
            $comune->setTipologiaProvincia($item['tipologia_provincia']);
            $comune->setCodiceRegione($item['codice_regione']);
            $comune->setDenominazioneRegione($item['denominazione_regione']);
            $comune->setTipologiaRegione($item['tipologia_regione']);
            $comune->setRipartizioneGeografica($item['ripartizione_geografica']);
            $comune->setFlagCapoluogo($item['flag_capoluogo']);
            $comune->setCodiceBelfiore($item['codice_belfiore']);
            $comune->setLat((float)$item['lat']);
            $comune->setLon((float)$item['lon']);
            $comune->setSuperficieKmq((float)$item['superficie_kmq']);

            $this->entityManager->persist($comune);
        }

        $this->entityManager->flush();

        $io->success('Data successfully loaded into the database.');

        return Command::SUCCESS;
    }
}