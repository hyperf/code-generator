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
namespace Hyperf\CodeGenerator\Visitor;

use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\NodeVisitorAbstract;

class RewriteModelVisitor extends NodeVisitorAbstract
{
    public BuilderFactory $factory;

    public function __construct()
    {
        $this->factory = new BuilderFactory();
    }

    public function leaveNode(Node $node)
    {
        switch (true) {
            case $node instanceof Node\Stmt\Property:
                $name = (string) $node->props[0]->name;
                return match ($name) {
                    'primaryKey', 'keyType' => tap($node, static function (Node\Stmt\Property $node) {
                        $node->type = new Identifier('string');
                    }),
                    'fillable', 'guarded', 'casts',
                    'dates', 'hidden', 'visible', 'appends',
                    'with', 'withCount' => tap($node, static function (Node\Stmt\Property $node) {
                        $node->type = new Identifier('array');
                    }),
                    'unguarded', 'timestamps', 'incrementing', 'exists','forceDeleting' => tap($node, static function (Node\Stmt\Property $node) {
                        $node->type = new Identifier('bool');
                    }),
                    'dateFormat', 'table', 'connection' => tap(
                        $node,
                        static function (Node\Stmt\Property $node) {
                            $node->type = new Node\NullableType(new Identifier('string'));
                        }
                    ),
                    'perPage' => tap(
                        $node,
                        static function (Node\Stmt\Property $node) {
                            $node->type = new Identifier('int');
                        }
                    ),
                };
        }

        return null;
    }
}
