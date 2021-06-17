<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\CodeGenerator\Command;

use Hyperf\CodeGenerator\CodeGenerator;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputOption;

#[Command]
class CodeGenerateCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('code:generate');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Generate code for Hyperf.');
        $this->addOption('flag', 'F', InputOption::VALUE_OPTIONAL, '1: Inject', CodeGenerator::FLAG_ALL);
    }

    public function handle()
    {
        $flat = (int) $this->input->getOption('flag');

        $generator = new CodeGenerator($flat);
    }
}
