<?php

namespace Hexatex\LaravelService;

use Closure;
use Illuminate\Database\Eloquent\Collection;

abstract class Service
{
    public function storeUpdateDestroyMany(
        array $fills,
        Collection $models,
        ?Closure $store,
        ?Closure $update,
        ?Closure $destroy,
    ): void {
        $models = $models->keyBy('id');

        $fillIds = [];
        foreach ($fills as $fill) {
            if (empty($fill['id'])) {
                if ($store) {
                    $store($fill);
                }

                continue;
            }

            $fillIds[$fill['id']] = true;

            if (! isset($models[$fill['id']])) {
                throw RuntimeException('Cannot update a model that does not exist in the collection');
            }

            if ($update) {
                $update($fill, $models[$fill['id']]);
            }
        }

        if (! $destroy) {
            return;
        }

        foreach ($models as $model) {
            if (! isset($fillIds[$model->id])) {
                $destroy($model);
            }
        }
    }
}
