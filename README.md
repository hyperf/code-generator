# 代码生成器

```shell
composer require hyperf/code-generator --dev -o
```

## 将 Doctrine 的注解转化为 PHP8 原生注解

- Inject

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
            Debug::class    
        ]       
    ];
```
