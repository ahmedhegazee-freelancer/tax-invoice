<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Carbon;
use Modules\AgeGroup\Entities\AgeGroup;

class AgeGroupService
{

    public static function __callStatic($name, $arguments)
    {
        return (new self)->$name(...$arguments);
    }
    protected function calculate(string $date)
    {
        $years = explode('-', $date)[0];
        return intval(now()->format('Y')) - \intval($years);
    }
    protected function findGroupID(int $age)
    {
        return AgeGroup::select(['id', 'from', 'to'])->where('to', '>=', $age)->where('from', '<=', $age)->first()->id;
    }
}