<?php

namespace Metarete\ComuniBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Metarete\ComuniBundle\Service\ComuniService;

#[AsCommand(
    name: 'metarete:comuni:load',
    description: 'Load comuni data from a JSON file into the database',
)]
class MetareteComuniLoadCommand extends Command
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ComuniService $comuniService,
    ) {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'Path to the JSON file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = $input->getArgument('file');

        if (!file_exists($filePath)) {
            $io->error('File not found: ' . $filePath);
            return Command::FAILURE;
        }

        $data = [];
        $jsonData = file_get_contents($filePath);
        if ($jsonData) {
            $data = json_decode($jsonData, true);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            $io->error('Invalid JSON data');
            return Command::FAILURE;
        }

        if(empty($data)) {
            $io->error('No data found in the JSON file');
            return Command::FAILURE;
        }

        $this->comuniService->truncateComuni();
        $num = $this->comuniService->importComuniFromArray($data);
        $io->success("$num comuni successfully loaded into the database.");

        return Command::SUCCESS;
    }
}
