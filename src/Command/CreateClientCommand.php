<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\OAuthServerBundle\Model\ClientManagerInterface;
use Symfony\Component\Console\Input\InputArgument;

class CreateClientCommand extends Command
{
    protected static $defaultName = 'oauth-server:client:create';
    protected $clientManager;

    public function __construct(ClientManagerInterface $clientManager) 
    {
        $this->clientManager = $clientManager;
        parent::__construct();
    }
    protected function configure()
    {
        $this
            // ->setName('acme:oauth-server:client:create')
            ->setDescription('Creates a new client')
            ->addArgument(
                'redirect-uri',
                InputArgument::REQUIRED,
                'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.',
                null
            )
            ->setHelp(
                <<<EOT
                    The <info>%command.name%</info>command creates a new client.
 
<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>
 
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->clientManager->createClient();
        $client->setRedirectUris([$input->getArgument('redirect-uri')]);
        $client->setAllowedGrantTypes(['authorization_code', 'password', 'refresh_token', 'token', 'client_credentials']);
        $this->clientManager->updateClient($client);
        $output->writeln(
            sprintf(
                'Added a new client with public id <info>%s</info>, secret <info>%s</info>',
                $client->getPublicId(),
                $client->getSecret()
            )
        );
    }
}
