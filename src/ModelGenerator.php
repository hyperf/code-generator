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
namespace Hyperf\CodeGenerator;

use Hyperf\CodeGenerator\Visitor\RewriteModelVisitor;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Finder\Finder;

class ModelGenerator
{
    public function generate(string $path): void
    {
        $finder = Finder::create()->in($path)->files()->name('*.php')->getIterator();
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
