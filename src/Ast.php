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

use Doctrine\Common\Annotations\Reader;
use Hyperf\CodeGenerator\Visitor\RewriteVisitor;
use PhpParser\NodeTraverser;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\PrettyPrinterAbstract;

class Ast
{
    private Parser $parser;

    private PrettyPrinterAbstract $printer;

    public function __construct(public Reader $reader)
    {
        $parserFactory = new ParserFactory();
        $this->parser = $parserFactory->create(ParserFactory::ONLY_PHP7);
        $this->printer = new Standard();
    }

    public function generate(string $code, array $annotations): string
    {
        $stmts = $this->parser->parse($code);
        $traverser = new NodeTraverser();
        $metadata = new Metadata($this->reader);
        $traverser->addVisitor(new RewriteVisitor($metadata, $annotations));
        $modifiedStmts = $traverser->traverse($stmts);
        return $metadata->isHandled() ? $this->printer->prettyPrintFile($modifiedStmts) : $code;
    }

    public function generate22(string $code, array $annotations): string
    {
        $stmts = $this->parser->parse($code);
        $traverser = new NodeTraverser();
        $metadata = new Metadata($this->reader);
        $traverser->addVisitor(new RewriteVisitor($metadata, $annotations));
        $modifiedStmts = $traverser->traverse($stmts);
        return $metadata->isHandled() ? $this->printer->prettyPrintFile($modifiedStmts) : $code;
    }
}
