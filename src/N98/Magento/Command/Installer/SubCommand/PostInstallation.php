<?php

namespace N98\Magento\Command\Installer\SubCommand;

use N98\Magento\Command\SubCommand\AbstractSubCommand;
use Symfony\Component\Console\Input\ArrayInput;

class PostInstallation extends AbstractSubCommand
{
    /**
     * @return bool
     */
    public function execute()
    {
        $this->getCommand()->getApplication()->setAutoExit(false);

        \chdir($this->config->getString('installationFolder'));
        $this->getCommand()->getApplication()->reinit();

        $this->output->writeln('<info>Reindex all after installation</info>');
        $this->getCommand()->getApplication()->run(
            new ArrayInput(['command' => 'index:reindex']),
            $this->output
        );

        /**
         * @TODO enable this after implementation of sys:check command
         */
        //$this->getCommand()->getApplication()->run(new StringInput('sys:check'), $this->output);
    }
}
