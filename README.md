# 代码生成器

```shell
composer require hyperf/code-generator --dev -o
```

## 将 Doctrine 的注解转化为 PHP8 原生注解

```shell
php bin/hyperf.php code:generate -D app
```

## 添加自定义注解

- 修改配置文件 config/autoload/annotations.php

```php
<?php
use App\Annotation\Debug;

return [
    'convert' => [
        Debug::class,
        // 当设置 convert 配置后，脚本便不会再使用默认配置，故需要主动添加如下配置
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
    ]       
];
```
