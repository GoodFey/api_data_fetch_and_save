<?php

namespace App\Traits;

trait DataVerification
{
    public static function getNullableField($responce)
    {
        $nullableField = [];
        foreach ($responce['data'] as $data) {
            foreach ($data as $key => $value) {
                if ($value == null && !in_array($key, $nullableField)) {
                    $nullableField[] = $key;
                }
            }
        }
        dump($nullableField);
    }

    public static function getMinMaxValue($responce)
    {
        $valuesByKey = [];
        foreach ($responce['data'] as $data) {
            foreach ($data as $key => $value) {
                if (!isset($valuesByKey[$key])) {
                    $valuesByKey[$key] = [];
                }
                $valuesByKey[$key][] = $value;
            }
        }



        $minMaxByKey = [];
        foreach ($valuesByKey as $key => $value) {
            $minMaxByKey[$key] = [
                'min' => min($value),
                'minLen' => strlen(min($value)),
                'max' => max($value),
                'maxLen' => strlen(max($value))
            ];
            dump($key);
            dump($minMaxByKey[$key]);

        }


    }

}
