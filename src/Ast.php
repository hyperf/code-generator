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

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Hyperf\Utils\Composer;
use PhpDocReader\PhpDocReader;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\PrettyPrinterAbstract;

class Ast
{
    private Parser $astParser;

    private PrettyPrinterAbstract $printer;

    private Reader $reader;

    private PhpDocReader $docReader;

    public function __construct()
    {
        $parserFactory = new ParserFactory();
        $this->astParser = $parserFactory->create(ParserFactory::ONLY_PHP7);
        $this->printer = new Standard();
        $this->reader = new AnnotationReader();
        $this->docReader = new PhpDocReader();
    }

    public function generate(string $className, array $visitors = [])
    {
        $code = $this->getCodeByClassName($className);
        $stmts = $this->astParser->parse($code);
        $traverser = new NodeTraverser();
        $metadata = new Metadata($className, $this->reader, $this->docReader);
        foreach ($visitors as $string) {
            $visitor = new $string($metadata);
            $traverser->addVisitor($visitor);
        }
        $modifiedStmts = $traverser->traverse($stmts);
        return $this->printer->prettyPrintFile($modifiedStmts);
    }

    private function getCodeByClassName(string $className): string
    {
        $file = Composer::getLoader()->findFile($className);
        if (! $file) {
            return '';
        }
        return file_get_contents($file);
    }
}
