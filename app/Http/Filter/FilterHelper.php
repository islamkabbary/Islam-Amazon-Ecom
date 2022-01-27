<?php

namespace App\Http\Filter;

use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Stmt\Foreach_;

class FilterHelper
{
    public static function apply(Builder $query, $con)
    {
        if (isset($con['keyword']) && $con['keyword']) {
            $keyword = $con['keyword'];
            $products = $query->where('name', "LIKE", "%" . $keyword . "%")
                ->orWhere('description', 'LIKE', "%" . $keyword . "%")
                ->orWhereHas('category', function ($item) use ($keyword) {
                    $item->where('name', "LIKE", "%" . $keyword . "%")
                        ->orWhere('description', 'LIKE', "%" . $keyword . "%");
                })->get();
            //   unset($con['keyword']);
        }
        // $relation_ids = array_filter(array_keys($con), function ($key) {
        //     return strpos($key, '_ids') !== false;
        // });

        // if (count($relation_ids)) {
        //     foreach ($relation_ids as $key => $relation) {
        //         $ids = explode(',',$con[$relation]);
        //         $relation_name = str_replace('_ids','',$relation);
        //     $products->whereHas($relation_name,function() use ($ids){
        //         unset($con[$relation]);
        //     });
        // }
        // }
        Redis::set(\Request::getRequestUri(),$products);
        return $products;
    }
}
