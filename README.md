# 代码生成器

```shell
composer require hyperf/code-generator --dev -o
```

## 将 Doctrine 的注解转化为 PHP8 原生注解

```shell
php bin/hyperf.php code:generate -D app
```
## 添加自定义的注解类

- 编辑 config/autoload/annotations.php
```php
<?php
    use App\Annotation\Note;
    
    return [
        'convert' => [
            Note::class,
        ]   
    ];
    
```