<?php

namespace Hexatex\LaravelService;

use Hexatex\LaravelMisc\Contracts\Model;
use Illuminate\Support\Collection;
use \Closure;
use \InvalidArgumentException;

abstract class Service
{
    protected $repository;

    /*
     * Protected Methods
     */
    /**
     * Allows you to store update & destroy Models in a Collection by defining callbacks to methods for each operation. See existing usage for examples.
     * 
     * @param Model[]|Collection $models
     */
    protected function storeUpdateDestroyMany(
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

            if (!isset($models[$fill['id']])) {
                continue; // The model was not found in the collection, don't throw as another user may have deleted it.
            }

            if ($update) {
                $update($fill, $models[$fill['id']]);
            }
        }

        if (!$destroy) {
            return;
        }

        foreach ($models as $model) {
            if (!isset($fillIds[$model->id])) {
                $destroy($model);
            }
        }
    }
}
