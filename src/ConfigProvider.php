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

use Hyperf\CodeGenerator\Command\CodeGenerateCommand;
use Hyperf\CodeGenerator\Command\UpgradeModelCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
                CodeGenerateCommand::class,
                UpgradeModelCommand::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
                'convert' => [
                    'Hyperf\Amqp\Annotation\Consumer',
                    'Hyperf\Amqp\Annotation\Producer',
                    'Hyperf\AsyncQueue\Annotation\AsyncQueueMessage',
                    'Hyperf\Cache\Annotation\Cacheable',
                    'Hyperf\Cache\Annotation\CacheEvict',
                    'Hyperf\Cache\Annotation\CachePut',
                    'Hyperf\Cache\Annotation\FailCache',
                    'Hyperf\CircuitBreaker\Annotation\CircuitBreaker',
                    'Hyperf\Command\Annotation\Command',
                    'Hyperf\Config\Annotation\Value',
                    'Hyperf\Constants\Annotation\Constants',
                    'Hyperf\Crontab\Annotation\Crontab',
                    'Hyperf\DbConnection\Annotation\Transactional',
                    'Hyperf\Di\Annotation\Aspect',
                    'Hyperf\Di\Annotation\Debug',
                    'Hyperf\Di\Annotation\Inject',
                    'Hyperf\Event\Annotation\Listener',
                    'Hyperf\ExceptionHandler\Annotation\ExceptionHandler',
                    'Hyperf\HttpServer\Annotation\AutoController',
                    'Hyperf\HttpServer\Annotation\Controller',
                    'Hyperf\HttpServer\Annotation\DeleteMapping',
                    'Hyperf\HttpServer\Annotation\GetMapping',
                    'Hyperf\HttpServer\Annotation\Middleware',
                    'Hyperf\HttpServer\Annotation\Middlewares',
                    'Hyperf\HttpServer\Annotation\PatchMapping',
                    'Hyperf\HttpServer\Annotation\PostMapping',
                    'Hyperf\HttpServer\Annotation\PutMapping',
                    'Hyperf\HttpServer\Annotation\RequestMapping',
                    'Hyperf\Kafka\Annotation\Consumer',
                    'Hyperf\Metric\Annotation\Counter',
                    'Hyperf\Metric\Annotation\Histogram',
                    'Hyperf\ModelListener\Annotation\ModelListener',
                    'Hyperf\Nats\Annotation\Consumer',
                    'Hyperf\Nsq\Annotation\Consumer',
                    'Hyperf\Process\Annotation\Process',
                    'Hyperf\RateLimit\Annotation\RateLimit',
                    'Hyperf\Retry\Annotation\BackoffRetryFalsy',
                    'Hyperf\Retry\Annotation\BackoffRetryThrowable',
                    'Hyperf\Retry\Annotation\CircuitBreaker',
                    'Hyperf\Retry\Annotation\Retry',
                    'Hyperf\Retry\Annotation\RetryFalsy',
                    'Hyperf\Retry\Annotation\RetryThrowable',
                    'Hyperf\RpcServer\Annotation\RpcService',
                    'Hyperf\Signal\Annotation\Signal',
                    'Hyperf\SocketIOServer\Annotation\Event',
                    'Hyperf\SocketIOServer\Annotation\SocketIONamespace',
                    'Hyperf\Task\Annotation\Task',
                    'Hyperf\Tracer\Annotation\Trace',
                ],
            ],
        ];
    }
}
