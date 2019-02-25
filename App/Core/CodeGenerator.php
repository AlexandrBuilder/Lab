<?php

namespace App\Core;

use App\Core\OperatorsLoader;

class CodeGenerator
{
    const FILE_PLACE = '/Web/';
    const FILE_PREFIX = 'libary_';

    const FILE_SIZES = [16,32,64,128];

    public static function getOperators($size)
    {
        global $CONFIG;

        $fileName = $CONFIG['SERVER_DIR'] . self::FILE_PLACE . self::FILE_PREFIX . $size;

        $operators = OperatorsLoader::loadOperators($fileName);

        $operators = self::prepareOperators($operators);

        return $operators;
    }

    public static function prepareOperators($operators)
    {
        foreach ($operators as $index => $operator) {
            $operators[$index] = [
                'count' => 0,
                'line' => $operator
            ];
        }

        return $operators;
    }

    public static function isFullCode(array $operators) {
        foreach ($operators as $operator) {
            if ($operator['count'] == 0) {
                return false;
            }
        }
        return true;
    }

    public static function generateCode($size)
    {
        $operators = self::getOperators($size);

        $countOperators = count($operators);

        do {
            $rand = rand(0, $countOperators - 1);
            $operators[$rand]['count']++;
        } while (!self::isFullCode($operators));

        $textProgram = '';

        $countOperators = 0;

        foreach ($operators as $operator) {
            $textProgram .= str_repeat($operator['line'], $operator['count']);
            $countOperators += $operator['count'];
        }

        return $countOperators;
    }
}