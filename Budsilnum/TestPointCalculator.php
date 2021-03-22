<?php

namespace Budsilnum;

use \RuntimeException;
use \InvalidArgumentException;


class TestResult
{
    const ECTOMORPH = 'ECTOMORPH';
    const ENDOMORPH = 'ENDOMORPH';
    const MESOMORPH = 'MESOMORPH';

    const SLOW_MUSCLE_FIBER_TYPE = 'SLOW_MUSCLE_FIBER_TYPE';
    const MIXED_MUSCLE_FIBER_TYPE = 'MIXED_MUSCLE_FIBER_TYPE';
    const FAST_MUSCLE_FIBER_TYPE = 'FAST_MUSCLE_FIBER_TYPE';

    const MALE = 'MALE';
    const FEMALE = 'FEMALE';

    const SLOW_CNS = 'SLOW_CNS';
    const MIDDLE_CNS = 'MIDDLE_CNS';
    const FAST_CNS = 'FAST_CNS';

    const BIG_LUNG_VOLUME = 'BIG_LUNG_VOLUME';
    const MEDIUM_LUNG_VOLUME = 'MEDIUM_LUNG_VOLUME';
    const SMALL_LUNG_VOLUME = 'SMALL_LUNG_VOLUME';

    private $sex;
    private $age;

    private $anthropometry;
    private $muscleFiberType;
    private $lungVolume;

    public function __construct(
        int $age,
        string $sex,
        string $anthropometry,
        int $jumpLength,
        int $breathHoldingTime
    )
    {
        if (!in_array($sex, [self::MALE, self::FEMALE])) {
            throw new InvalidArgumentException('Передано недопустимое значение для пола.');
        }

        $this->sex = $sex;

        if ($age < 6 || $age > 10) {
            throw new InvalidArgumentException('Возраст должен быть в пределах от 6 до 10.');
        }

        $this->age = $age;

        if (!in_array($anthropometry, [self::ECTOMORPH, self::ENDOMORPH, self::MESOMORPH])) {
            throw new InvalidArgumentException('Передано недопустимое значение для Антропометрии.');
        }

        $this->anthropometry = $anthropometry;

        $this->muscleFiberType = $this->_getMuscleFiberTypeResult($age, $sex, $jumpLength);

        if (!in_array($this->muscleFiberType, [self::SLOW_MUSCLE_FIBER_TYPE, self::MIXED_MUSCLE_FIBER_TYPE, self::FAST_MUSCLE_FIBER_TYPE])) {
            throw new RuntimeException('Ошибка при расчете muscleFiberType, получили недопустимое значение.');
        }

        $this->lungVolume = $this->_getLungVolumeResult($age, $breathHoldingTime);

        if (!in_array($this->lungVolume, [self::BIG_LUNG_VOLUME, self::MEDIUM_LUNG_VOLUME, self::SMALL_LUNG_VOLUME])) {
            throw new RuntimeException('Ошибка при расчете lungVolume, получили недопустимое значение.');
        }
    }

    private function _getMuscleFiberTypeResult(int $age, string $sex, int $jumpLength): string
    {
        switch ($age) {
            case 6:
            case 7:
                if ($sex === self::MALE) {
                    if ($jumpLength < 115) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 115 && $jumpLength <= 140) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                if ($sex === self::FEMALE) {
                    if ($jumpLength < 110) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 110 && $jumpLength <= 130) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                throw new InvalidArgumentException('Недопустимое значение пола.');
            case 8:
                if ($sex === self::MALE) {
                    if ($jumpLength < 125) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 125 && $jumpLength <= 165) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                if ($sex === self::FEMALE) {
                    if ($jumpLength < 120) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 120 && $jumpLength <= 155) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                throw new InvalidArgumentException('Недопустимое значение пола.');
            case 9:
            case 10:
                if ($sex === self::MALE) {
                    if ($jumpLength < 140) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 140 && $jumpLength <= 180) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                if ($sex === self::FEMALE) {
                    if ($jumpLength < 135) {
                        return self::SLOW_MUSCLE_FIBER_TYPE;
                    }

                    if ($jumpLength >= 135 && $jumpLength <= 170) {
                        return self::MIXED_MUSCLE_FIBER_TYPE;
                    }

                    return self::FAST_MUSCLE_FIBER_TYPE;
                }

                throw new InvalidArgumentException('Недопустимое значение пола.');
            default:
                throw new InvalidArgumentException('Недопустимое значение возраста.');
        }
    }

    private function _getLungVolumeResult(int $age, int $breathHoldingTime): string
    {
        switch ($age) {
            case 6:
                if ($breathHoldingTime < 14) {
                    return self::SMALL_LUNG_VOLUME;
                }

                if ($breathHoldingTime >= 14 && $breathHoldingTime <= 17) {
                    return self::MEDIUM_LUNG_VOLUME;
                }

                return self::BIG_LUNG_VOLUME;
            case 7:
                if ($breathHoldingTime < 20) {
                    return self::SMALL_LUNG_VOLUME;
                }

                if ($breathHoldingTime >= 20 && $breathHoldingTime <= 28) {
                    return self::MEDIUM_LUNG_VOLUME;
                }

                return self::BIG_LUNG_VOLUME;
            case 8:
                if ($breathHoldingTime < 26) {
                    return self::SMALL_LUNG_VOLUME;
                }

                if ($breathHoldingTime >= 26 && $breathHoldingTime <= 32) {
                    return self::MEDIUM_LUNG_VOLUME;
                }

                return self::BIG_LUNG_VOLUME;
            case 9:
                if ($breathHoldingTime < 28) {
                    return self::SMALL_LUNG_VOLUME;
                }

                if ($breathHoldingTime >= 28 && $breathHoldingTime <= 34) {
                    return self::MEDIUM_LUNG_VOLUME;
                }

                return self::BIG_LUNG_VOLUME;
            case 10:
                if ($breathHoldingTime < 31) {
                    return self::SMALL_LUNG_VOLUME;
                }

                if ($breathHoldingTime >= 31 && $breathHoldingTime <= 37) {
                    return self::MEDIUM_LUNG_VOLUME;
                }

                return self::BIG_LUNG_VOLUME;
            default:
                throw new InvalidArgumentException('Недопустимое значение возраста.');
        }
    }

    public function getTestPoints(): array
    {
        return [
            [$this->anthropometry === self::ECTOMORPH ? 1 : 0],
            [$this->anthropometry === self::ENDOMORPH ? 1 : 0],
            [$this->anthropometry === self::MESOMORPH ? 1 : 0],

            [$this->muscleFiberType === self::SLOW_MUSCLE_FIBER_TYPE ? 1 : 0],
            [$this->muscleFiberType === self::MIXED_MUSCLE_FIBER_TYPE ? 1 : 0],
            [$this->muscleFiberType === self::FAST_MUSCLE_FIBER_TYPE ? 1 : 0],

            [$this->lungVolume === self::SMALL_LUNG_VOLUME ? 1 : 0],
            [$this->lungVolume === self::MEDIUM_LUNG_VOLUME ? 1 : 0],
            [$this->lungVolume === self::BIG_LUNG_VOLUME ? 1 : 0],
        ];
    }
}