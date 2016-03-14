<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function toSelectOptions(Collection $collections, $keyField = 'id', $keyValue = 'name') {

        $options = [];
        foreach ($collections as $collection) {
            $options[$collection->{$keyField}] = $collection->{$keyValue};
        }

        return $options;
    }
}
