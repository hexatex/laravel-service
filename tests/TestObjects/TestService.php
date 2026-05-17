<?php

namespace Hexatex\LaravelService\Tests\TestObjects;

use Hexatex\LaravelService\Service;
use Illuminate\Support\Collection;
use \Closure;

class TestService extends Service
{
    public function storeUpdateDestroy(
        array $fills,
        Collection $models,
        ?Closure $store,
        ?Closure $update,
        ?Closure $destroy,
    ) {
        $this->storeUpdateDestroyMany($fills, $models, $store, $update, $destroy);
    }
}
