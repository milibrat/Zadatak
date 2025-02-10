<?php

namespace App\Command;

use App\Repository\EntryRepository;
use App\Service\ScoreService;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;



class GetScoreCommand extends Command
{
    protected static $defaultName = 'app:GetScore';
    private $entityManager;
    private $repository;
    private $scoreService;

    public function __construct(EntityManagerInterface $entityManager, EntryRepository $repository, ScoreService $scoreService)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->scoreService = $scoreService;
    }
    

    protected function configure()
    {
        $this->setName('app:GetScore')->addArgument('word', InputArgument::OPTIONAL, 'Your word:')
            ->setDescription('Calc score.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        
        $helper = $this->getHelper('question');
        $question = new Question('Please enter a word: ', '');

        $word = $helper->ask($input, $output, $question);
        
        if ($word === "") {
            $output->writeln("No word provided");
            return Command::FAILURE;
        }

        $output->writeln("You entered: $word");
        
        $entryCount = $this->repository->countWordsCaseInsensitive($word);

        
        $score = 0;
        if ($entryCount > 0) {
            
            $score = $this->scoreService->calculateScore($word);
        }

        $output->writeln("Score for '$word': $score");
        

        return Command::SUCCESS;
    }
}