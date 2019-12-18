<?php
namespace App\Command;

use App\BusinessService\PersonBusinessService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;
use App\Utils\Validator;


class InputCommand extends Command
{
    protected static $defaultName = 'app:search-command';

    private $io;
    private $personBusinessService;
    private $validator;

    public function __construct(PersonBusinessService  $personBusinessService, Validator $validator)
    {
        parent::__construct();
        $this->personBusinessService = $personBusinessService;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Introduces search command to look by words')
            ->addArgument('query', InputArgument::OPTIONAL, 'The query is required to find by elements');
    }

    /**
     * This optional method is the first one executed for a command after configure()
     * and is useful to initialize properties based on the input arguments and options.
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getArgument('query')) {
            return;
        }

        $this->io->title('Interactive Wizard command');
        $this->io->text([
            'If you prefer to not use this interactive wizard command, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php bin/console app:search-command query azulados',
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
        ]);

        $query = $input->getArgument('query');

        if (null !== $query) {
            $this->io->text(' > <info>Query introduced</info>: '.$query);
        } else {
            $query= $this->io->ask('Query to look by words: ','', [$this->validator, 'validateQuery']);
            $input->setArgument('query', $query);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('app:search-command');
        $query = $input->getArgument('query');

        try {
            $result = $this->personBusinessService->findBySearchQuery($query);
            $output->writeln($result);
            $this->io->success($result);
            return 0;
        } catch(\Exception $e) {
            $this->io->success($e->getMessage());
            return 0;
        }
    }
}
