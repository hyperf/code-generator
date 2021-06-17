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

use Hyperf\Di\Annotation\Inject;

class Foo
{
    /**
     * @Inject
     * @var Bar
     */
    public $bar;

    /**
     * Hello World.
     * @Inject
     */
    public Bar $bar2;

    /**
     * No Inject.
     */
    public $bar3;

    #[Inject]
    public Bar $bar4;
}
