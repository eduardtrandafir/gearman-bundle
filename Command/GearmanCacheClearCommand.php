<?php

namespace EduardTrandafir\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use EduardTrandafir\GearmanBundle\Command\Abstracts\AbstractGearmanCommand;
use EduardTrandafir\GearmanBundle\Service\GearmanCacheWrapper;

/**
 * Clears all cache data
 */
class GearmanCacheClearCommand extends AbstractGearmanCommand
{
    /**
     * @var GearmanCacheWrapper
     *
     * GearmanCacheWrapper
     */
    protected $gearmanCacheWrapper;

    /**
     * Set the GearmanCacheWrapper instance
     *
     * @param GearmanCacheWrapper $gearmanCacheWrapper GearmanCacheWrapper
     *
     * @return GearmanCacheWarmupCommand self Object
     */
    public function setGearmanCacheWrapper(GearmanCacheWrapper $gearmanCacheWrapper)
    {
        $this->gearmanCacheWrapper = $gearmanCacheWrapper;

        return $this;
    }

    /**
     * Console Command configuration
     */
    protected function configure()
    {
        $this
            ->setName('gearman:cache:clear')
            ->setAliases(array(
                'cache:gearman:clear'
            ))
            ->setDescription('Clears gearman cache data on current environment');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract class is not implemented
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getOption('quiet')) {
            $kernelEnvironment = $this
                ->kernel
                ->getEnvironment();

            $output->writeln('Clearing the cache for the ' . $kernelEnvironment . ' environment');
        }
        $this
            ->gearmanCacheWrapper
            ->clear('');
    }
}
