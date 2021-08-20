<?php

declare(strict_types=1);


namespace HyperfTest\Stub;


class FooMiddleware
{
    public function process($request,$handler)
    {
        return $handler->handle($request);
    }
}