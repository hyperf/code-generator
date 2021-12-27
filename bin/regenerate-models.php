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
use Hyperf\CodeGenerator\ModelGenerator;

require_once 'vendor/autoload.php';

if (! isset($argv[1])) {
    echo 'Please input your model path';
    exit;
}

$generator = new ModelGenerator();

$generator->generate($argv[1]);
