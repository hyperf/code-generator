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

use Hyperf\CodeGenerator\Visitor\RewriteModelVisitor;
use Hyperf\Command\Command as HyperfCommand;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Finder\Finder;

class UpgradeModelCommand extends HyperfCommand
{
    public function __construct()
    {
        parent::__construct('code:regenerate-models');
        $this->addArgument('path', InputArgument::REQUIRED, 'The path about Models.', 'app/Model');
        $this->setDescription('重新生成适配 Hyperf 3.0 版本的模型');
    }

    public function handle()
    {
        $path = $this->input->getArgument('path');
        $finder = Finder::create()->in(BASE_PATH . '/' . $path)->getIterator();
        $parserFactory = new ParserFactory();

        foreach ($finder as $value) {
            $path = $value->getRealPath();

            $parser = $parserFactory->create(ParserFactory::ONLY_PHP7);
            $printer = new Standard();

            $stmts = $parser->parse(file_get_contents($path));
            $traverser = new NodeTraverser();
            $traverser->addVisitor(new RewriteModelVisitor());
            $modifiedStmts = $traverser->traverse($stmts);
            $code = $printer->prettyPrintFile($modifiedStmts);

            file_put_contents($path, $code);
        }
    }
}
