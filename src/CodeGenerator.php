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

class CodeGenerator implements CodeGeneratorInterface
{
    public function __construct(public Ast $ast)
    {
    }

    public function generate(string $code): string
    {
        return $this->ast->generate($code, $this->getAnnotations());
    }

    protected function getAnnotations(): array
    {
        /* @var array $annotations */
        return (array) config('annotations.convert');
    }
}
