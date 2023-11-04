<?php

namespace App\trait;

use Illuminate\Support\Str;

trait toArrayCamelCase
{
    public function toArrayCamelCase()
    {
        $data = parent::toArray();
        foreach ($data as $key => $value) {
            $camelKey = Str::camel($key);
            $data[$camelKey] = $value;
            if($camelKey !== $key) {
                unset($data[$key]);
            }
        }
        return $data;
    }
}
