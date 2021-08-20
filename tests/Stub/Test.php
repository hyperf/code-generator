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

/**
 * @Annotation
 * @Aspect
 */
class Test extends ParentClass
{
    /**
     * @Value("int_array")
     * @var int[]
     */
    public $valueNoTypeProperty;

    /**
     * @Value("int")
     */
    public int $valueHasTypeProperty;

    /**
     * @Value("int_array")
     * @var int[]
     */
    public $valueArrayTypeProperty;

    /**
     * @Value("callable")
     * @var callable
     */
    public $valueCallableProperty;

    /**
     * @Value("int_or_null")
     * @var ?int
     */
    public $valueIntOrNullProperty;

    /**
     * @Value("foo_or_null")
     * @var null|Foo
     */
    public $valueFooOrNullProperty2;

    /**
     * @Inject
     * @var Foo
     */
    public $injectNoTypeProperty;

    /**
     * Hello World.
     * @Inject
     */
    public Foo $injectHasTypeProperty;

    /**
     * @Inject
     * @var static
     */
    public $injectStaticProperty;

    /**
     * @Inject
     * @var self
     */
    public $injectSelfProperty;
}
