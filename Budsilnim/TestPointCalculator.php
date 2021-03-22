<?php

namespace Budsilnim;

use \RuntimeException;
use \InvalidArgumentException;


class TestPointCalculator
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

    const ART_PSYCHOLOGY = 'ART_PSYCHOLOGY';
    const RECORD_PSYCHOLOGY = 'RECORD_PSYCHOLOGY';
    const CONTACT_PSYCHOLOGY = 'CONTACT_PSYCHOLOGY';

    const GOOD_FLEXIBILITY = 'GOOD_FLEXIBILITY';
    const MIDDLE_FLEXIBILITY = 'MIDDLE_FLEXIBILITY';
    const BAD_FLEXIBILITY = 'BAD_FLEXIBILITY';

    const GOOD_COORDINATION = 'GOOD_COORDINATION';
    const MIDDLE_COORDINATION = 'MIDDLE_COORDINATION';
    const BAD_COORDINATION = 'BAD_COORDINATION';

    const SLOW_REACTION = 'SLOW_REACTION';
    const MIDDLE_REACTION = 'MIDDLE_REACTION';
    const FAST_REACTION = 'FAST_REACTION';

    const BIG_HEIGHT = 'BIG_HEIGHT';
    const MEDIUM_HEIGHT = 'MEDIUM_HEIGHT';
    const SMALL_HEIGHT = 'SMALL_HEIGHT';

    private $sex;
    private $age;

    private $anthropometry;
    private $muscleFiberType;
    private $lungVolume;
    private $psychology;
    private $cns;
    private $flexibility;
    private $reaction;
    private $coordination;
    private $possibleHeight;

    public function __construct(
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

        if (!in_array($psychology, [self::ART_PSYCHOLOGY, self::RECORD_PSYCHOLOGY, self::CONTACT_PSYCHOLOGY])) {
            throw new InvalidArgumentException('Передано недопустимое значение для психологии.');
        }

        $this->psychology = $psychology;

        $this->cns = $this->_getCNSResult($timeToFindASolution);

        if (!in_array($this->cns, [self::FAST_CNS, self::MIDDLE_CNS, self::SLOW_CNS])) {
            throw new RuntimeException('Ошибка при расчете cns, получили недопустимое значение.');
        }

        if (!in_array($flexibility, [self::GOOD_FLEXIBILITY, self::MIDDLE_FLEXIBILITY, self::BAD_FLEXIBILITY])) {
            throw new InvalidArgumentException('Передано недопустимое значение для Антропометрии.');
        }

        $this->flexibility = $flexibility;

        $this->reaction = $this->_getReactionResult($reactionTime);

        if (!in_array($this->reaction, [self::FAST_REACTION, self::MIDDLE_REACTION, self::SLOW_REACTION])) {
            throw new RuntimeException('Ошибка при расчете reaction, получили недопустимое значение.');
        }

        $this->coordination = $this->_getCoordinationResult($someCoordination);

        if (!in_array($this->coordination, [self::GOOD_COORDINATION, self::MIDDLE_COORDINATION, self::BAD_COORDINATION])) {
            throw new RuntimeException('Ошибка при расчете coordination, получили недопустимое значение.');
        }

        $this->possibleHeight = $this->_getPossibleHeightResult($fatherHeight, $motherHeight);

        if (!in_array($this->possibleHeight, [self::SMALL_HEIGHT, self::MEDIUM_HEIGHT, self::BIG_HEIGHT])) {
            throw new RuntimeException('Ошибка при расчете coordination, получили недопустимое значение.');
        }
    }

    /**
     * @param int $fatherHeight
     * @param int $motherHeight
     * @return string
     */
    private function _getPossibleHeightResult(int $fatherHeight, int $motherHeight): string
    {
        if ($fatherHeight < 170 && $motherHeight < 170) {
            return self::SMALL_HEIGHT;
        }

        if (($fatherHeight < 170 && $motherHeight > 180) || ($motherHeight < 170 && $fatherHeight > 180)) {
            return self::MEDIUM_HEIGHT;
        }

        return self::BIG_HEIGHT;
    }

    /**
     * @param int $timeToFindASolution
     * @return string
     */
    private function _getCNSResult(int $timeToFindASolution): string
    {
        // TODO: Добаваить реальные расчеты, сейчас тут фейк, т.к. нет данных от бизнеса.
        if ($timeToFindASolution < 100) {
            return self::FAST_CNS;
        }

        if ($timeToFindASolution > 100 && $timeToFindASolution < 200) {
            return self::MIDDLE_CNS;
        }

        return self::SLOW_CNS;
    }

    /**
     * @param int $someCoordination
     * @return string
     */
    private function _getCoordinationResult(int $someCoordination): string
    {
        // TODO: Добаваить реальные расчеты, сейчас тут фейк, т.к. нет данных от бизнеса.
        if ($someCoordination < 100) {
            return self::GOOD_COORDINATION;
        }

        if ($someCoordination > 100 && $someCoordination < 200) {
            return self::MIDDLE_COORDINATION;
        }

        return self::BAD_COORDINATION;
    }

    /**
     * @param int $reactionTime
     * @return string
     */
    private function _getReactionResult(int $reactionTime): string
    {
        // TODO: Добаваить реальные расчеты, сейчас тут фейк, т.к. нет данных от бизнеса.
        if ($reactionTime < 100) {
            return self::FAST_REACTION;
        }

        if ($reactionTime > 100 && $reactionTime < 200) {
            return self::MIDDLE_REACTION;
        }

        return self::SLOW_REACTION;
    }

    /**
     * @param int $age
     * @param string $sex
     * @param int $jumpLength
     * @return string
     */
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

    /**
     * @param int $age
     * @param int $breathHoldingTime
     * @return string
     */
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

    /**
     * @return \int[][]
     */
    public function calculate(): array
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

            [$this->psychology === self::ART_PSYCHOLOGY ? 1 : 0],
            [$this->psychology === self::RECORD_PSYCHOLOGY ? 1 : 0],
            [$this->psychology === self::CONTACT_PSYCHOLOGY ? 1 : 0],

            [$this->cns === self::SLOW_CNS ? 1 : 0],
            [$this->cns === self::MIDDLE_CNS ? 1 : 0],
            [$this->cns === self::FAST_CNS ? 1 : 0],

            [$this->flexibility === self::BAD_FLEXIBILITY ? 1 : 0],
            [$this->flexibility === self::MIDDLE_FLEXIBILITY ? 1 : 0],
            [$this->flexibility === self::GOOD_FLEXIBILITY ? 1 : 0],

            [$this->reaction === self::SLOW_REACTION ? 1 : 0],
            [$this->reaction === self::MIDDLE_REACTION ? 1 : 0],
            [$this->reaction === self::FAST_REACTION ? 1 : 0],

            [$this->coordination === self::BAD_COORDINATION ? 1 : 0],
            [$this->coordination === self::MIDDLE_COORDINATION ? 1 : 0],
            [$this->coordination === self::GOOD_COORDINATION ? 1 : 0],

            [$this->sex === self::MALE ? 1 : 0],
            [$this->sex === self::FEMALE ? 1 : 0],

            [$this->possibleHeight === self::SMALL_HEIGHT ? 1 : 0],
            [$this->possibleHeight === self::MEDIUM_HEIGHT ? 1 : 0],
            [$this->possibleHeight === self::BIG_HEIGHT ? 1 : 0],
        ];
    }
}