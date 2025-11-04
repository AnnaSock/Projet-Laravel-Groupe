<?php

use Illuminate\Database\Eloquent\Model;


class UuidObserver{
    public function creating(Model $model)
    {
        if (empty($model->id)) {
            $model->id = (string) \Illuminate\Support\Str::uuid();
        }
    }

}