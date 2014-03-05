<?php

namespace Ebeer\PhoenixServerBundle\Command;

use Phoenix\Command\GeneratePackages;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GeneratePackagesCommand extends GeneratePackages implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface|null
     */
    private $container;

    protected function configure()
    {
        $this
            ->setName('ebeer:phoenix:generate-packages')
            ->setDescription('Generates JS packages')
            ->setHelp(<<<EOT
The <info>ebeer:phoenix:generate-packages</info> command generates all js packages defined in the application:

  <info>php app/console ebeer:phoenix:generate-packages</info>
EOT
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|null
     */
    protected function getConfig(InputInterface $input, OutputInterface $output)
    {
        return $this->getContainer()->get('ebeer.phoenix.loader')->getConfig();
    }

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        if (null === $this->container) {
            $this->container = $this->getApplication()->getKernel()->getContainer();
        }

        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
