<?php

namespace App\Core;

class OperatorsLoader
{
    public static function loadOperators($fileName)
    {
        $lines = file($fileName);

        foreach ($lines as $line) {
            $operators[] = trim($line);
        }

        return $operators;
    }
}