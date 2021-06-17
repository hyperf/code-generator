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

use Hyperf\CodeGenerator\Ast;
use Hyperf\CodeGenerator\CodeGenerator;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;

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
        $this->addOption('dir', 'D', InputOption::VALUE_OPTIONAL, 'Which dir will be rewrite.', 'app');
    }

    public function handle()
    {
        $flag = (int) $this->input->getOption('flag');
        $dir = $this->input->getOption('dir');

        $dir = BASE_PATH . '/' . $dir;
        if (! is_dir($dir)) {
            $this->output->error('The dir does not exists.');
            return;
        }

        $finder = Finder::create()->files()
            ->ignoreVCS(true)
            ->path('.php')
            ->in($dir);

        $generator = new CodeGenerator($flag, new Ast());

        foreach ($finder as $item) {
            $path = $item->getRealPath();
            $code = $generator->generate(file_get_contents($path));
            file_put_contents($path, $code);
        }
    }
}