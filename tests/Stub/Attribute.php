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
namespace HyperfTest\Stub;

use Hyperf\Config\Annotation\Value;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Middleware;

/**
 * @Annotation
 */
#[Aspect]
class Attribute extends ParentClass
{
    /**
     * @var int[]
     */
    #[Value(key: 'int_array')]
    public $valueNoTypeProperty;

    #[Value(key: 'int')]
    public int $valueHasTypeProperty;

    #[Value(key: 'int_array')]
    public array $valueArrayTypeProperty;

    /**
     * @var callable
     */
    #[Value(key: 'callable')]
    public $valueCallableProperty;

    #[Value(key: 'int_or_null')]
    public ?int $valueIntOrNullProperty;

    #[Value(key: 'foo_or_null')]
    public null|Foo $valueFooOrNullProperty2;

    #[Inject(value: Foo::class)]
    public $injectNoTypeProperty;

    /**
     * Hello World.
     */
    #[Inject]
    public Foo $injectHasTypeProperty;

    #[Inject]
    public static $injectStaticProperty;

    #[Inject]
    public self $injectSelfProperty;

    public function noneAttributesMethod() :void
    {

    }

    #[Middleware(BarMiddleware::class)]
    #[Middleware(FooMiddleware::class)]
    public function testMiddlewaresAnnotation() :void
    {
    }
}
