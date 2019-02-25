<?php
namespace App;

use App\Core\CodeGenerator;

class Controller
{
    const SIZE_EXPERIMENTS = [16, 32, 64, 128, 89];

    public static function getExperimentalValues($size)
    {
        $n = 2000;

        $iteration = [];

        $lenghtCodeAll = 0;

        for ($i = 0; $i < $n; $i++) {
            $lenghtCode = CodeGenerator::generateCode($size);

            $iteration[] = $lenghtCode;

            $lenghtCodeAll += $lenghtCode;
        }

        $expectedValue = $lenghtCodeAll / $n;

        $intermediateValues = 0;

        for ($i = 0; $i < $n; $i++) {
            $intermediateValues += pow(($iteration[$i] - $expectedValue), 2);
        }

        $dispersion = $intermediateValues / $n;

        $expectedError = sqrt($dispersion) / $expectedValue;

        return [
            'expectedValue' => $expectedValue,
            'dispersion' => $dispersion,
            'expectedError' => $expectedError
        ];
    }

    public static function getTheoreticalValuesValues($size)
    {
        $expectedValue = 0.9 * $size * log($size, 2);

        $dispersion = pow(pi(), 2) * pow($size, 2) / 6;

        $expectedError = 1 / (2 * log($size, 2));

        return [
            'expectedValue' => $expectedValue,
            'dispersion' => $dispersion,
            'expectedError' => $expectedError
        ];
    }

    public function controller()
    {
        $experimentValues = [];
        $theoreticalValues = [];

        foreach (self::SIZE_EXPERIMENTS as $sizeExperiment){
            $experimentValues[$sizeExperiment] = self::getExperimentalValues($sizeExperiment);
            $theoreticalValues[$sizeExperiment] = self::getTheoreticalValuesValues($sizeExperiment);
        }

        return [
            'experimentValues' => $experimentValues,
            'theoreticalValues' => $theoreticalValues
        ];
    }
}