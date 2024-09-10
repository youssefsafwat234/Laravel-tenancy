<?php

namespace App\Traits;

use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;

trait StoreScope
{
    public static function bootStoreScope()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $store = app()->make('store.active');
            if ($store) {
                $builder->where('store_id', $store->id);
            }
        });
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
