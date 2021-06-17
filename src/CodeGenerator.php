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

use Hyperf\CodeGenerator\Visitor\RewriteInjectVisitor;

class CodeGenerator implements CodeGeneratorInterface
{
    public const FLAG_INJECT = 1;

    public const FLAG_ALL = 1023;

    protected array $visitors = [];

    public function __construct(public int $flag, public Ast $ast)
    {
    }

    public function generate(string $className): string
    {
        return $this->ast->generate($className, $this->getVisitors());
    }

    protected function getVisitors(): array
    {
        $visitors = [];
        if ($this->flag & self::FLAG_INJECT) {
            $visitors[] = RewriteInjectVisitor::class;
        }

        return $visitors;
    }
}
