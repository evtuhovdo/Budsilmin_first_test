<?php

namespace Budsilnim;

require_once __DIR__ . '/ResultCalculator.php';
require_once __DIR__ . '/TestPointCalculator.php';

class SportMatchTest
{
    /**
     * @param int $age
     * @param string $sex
     * @param string $anthropometry
     * @param int $jumpLength
     * @param int $breathHoldingTime
     * @param string $psychology
     * @param int $timeToFindASolution
     * @param string $flexibility
     * @param int $reactionTime
     * @param int $someCoordination
     * @param int $fatherHeight
     * @param int $motherHeight
     *
     * @return array
     */
    public function getResult(
        int $age,
        string $sex,
        string $anthropometry,
        int $jumpLength,
        int $breathHoldingTime,
        string $psychology,
        int $timeToFindASolution,
        string $flexibility,
        int $reactionTime,
        int $someCoordination,
        int $fatherHeight,
        int $motherHeight
    ): array
    {
        $resultCalculator = new ResultCalculator();

        $testPoints = new TestPointCalculator(
            $age,
            $sex,
            $anthropometry,
            $jumpLength,
            $breathHoldingTime,
            $psychology,
            $timeToFindASolution,
            $flexibility,
            $reactionTime,
            $someCoordination,
            $fatherHeight,
            $motherHeight
        );

        $testPointsRes = $testPoints->calculate();

        return $resultCalculator->getResultWithSportNames($testPointsRes);
    }
}