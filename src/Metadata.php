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
use PhpDocReader\PhpDocReader;

class Metadata
{
    public function __construct(
        public string $className,
        public Reader $reader,
        public PhpDocReader $docReader,
    ) {
    }
}
