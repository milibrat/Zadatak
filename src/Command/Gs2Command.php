<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Console\Question\Question;




class Gs2Command extends Command
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:Gs2')
            ->setDescription('Fetch data from an external API.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        
        
        $helper = $this->getHelper('question');
        $question = new Question('Please enter a word: ', '');

        $word = $helper->ask($input, $output, $question);

        if (empty($word)) {
            $output->writeln('No word provided.');
            return Command::FAILURE;
        }

        $output->writeln("You entered: $word");

        $response = $this->client->request('POST', 'http://localhost:8000/entry', [
            'json' => ['word' => $word], 
            'headers' => [
                'Content-Type' => 'application/json',  
            ],
        ]);
        
        if ($response->getStatusCode() === 200) {
            
            $data = $response->toArray();  
            $output->writeln("Score for '$word': ".$data['score']);
        
        } else {
            $output->writeln('Failed to fetch data from API.');
        }
        
        return Command::SUCCESS;
    }
}