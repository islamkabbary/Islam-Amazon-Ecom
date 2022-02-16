<?php

namespace App\Trait;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiPagination
{
    public function getPaginationData(LengthAwarePaginator $paginateObject ,ResourceCollection $resourceCollection)
    {
        $paginateObject = $paginateObject->toArray();
        return [
            'data' => $resourceCollection,
            'links' => $paginateObject['links'],
            'total' => $paginateObject['total'],
        ];
    }
}