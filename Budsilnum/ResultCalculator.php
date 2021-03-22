<?php

namespace Budsilnum;

use \RuntimeException;
use \InvalidArgumentException;
use vermotr\Math\Matrix;

class ResultCalculator
{
    const SPORTS = [
        [
            'id' => 0,
            'name' => 'Академическая гребля',
        ],
        [
            'id' => 1,
            'name' => 'Автоспорт',
        ],
        [
            'id' => 2,
            'name' => 'Бадминтон',
        ],
        [
            'id' => 3,
            'name' => 'Баскетбол',
        ],
        [
            'id' => 4,
            'name' => 'Биатлон',
        ],
        [
            'id' => 5,
            'name' => 'Бобслей',
        ],
        [
            'id' => 6,
            'name' => 'Бокс',
        ],
        [
            'id' => 7,
            'name' => 'Борьба вольная',
        ],
        [
            'id' => 8,
            'name' => 'Борьба греко-римская',
        ],
        [
            'id' => 9,
            'name' => 'Вело спорт шорт трек',
        ],
        [
            'id' => 10,
            'name' => 'Вело спорт кросс',
        ],
        [
            'id' => 11,
            'name' => 'Вело спорт кросс кантри',
        ],
        [
            'id' => 12,
            'name' => 'Водное поло',
        ],
        [
            'id' => 13,
            'name' => 'Воллейбол',
        ],
        [
            'id' => 14,
            'name' => 'Гандбол',
        ],
        [
            'id' => 15,
            'name' => 'Гимнастика',
        ],
        [
            'id' => 16,
            'name' => 'Гиревой спорт',
        ],
        [
            'id' => 17,
            'name' => 'Горнолыжный спорт слалом',
        ],
        [
            'id' => 18,
            'name' => 'Гребля на байдарках/каноэ',
        ],
        [
            'id' => 19,
            'name' => 'Дзюдо',
        ],
        [
            'id' => 20,
            'name' => 'Карате',
        ],
        [
            'id' => 21,
            'name' => 'Керлинг',
        ],
        [
            'id' => 22,
            'name' => 'Кикбоксинг',
        ],
        [
            'id' => 23,
            'name' => 'Конный спорт',
        ],
        [
            'id' => 24,
            'name' => 'Конькобежный спорт спринт',
        ],
        [
            'id' => 25,
            'name' => 'Конькобежный спорт стайер',
        ],
        [
            'id' => 26,
            'name' => 'Легкая атлетика спринт',
        ],
        [
            'id' => 27,
            'name' => 'легкая атлетика стайер',
        ],
        [
            'id' => 28,
            'name' => 'Метания (молот, ядра, и тд)',
        ],
        [
            'id' => 29,
            'name' => 'Прыжки в длину / высоту',
        ],
        [
            'id' => 30,
            'name' => 'Лыжный гонки',
        ],
        [
            'id' => 31,
            'name' => 'Мини футбол',
        ],
        [
            'id' => 32,
            'name' => 'Мото спорт',
        ],
        [
            'id' => 33,
            'name' => 'Настольный теннис',
        ],
        [
            'id' => 34,
            'name' => 'Парусный спорт',
        ],
        [
            'id' => 35,
            'name' => 'Пауэрлифтинг',
        ],
        [
            'id' => 36,
            'name' => 'Плавание спринт',
        ],
        [
            'id' => 37,
            'name' => 'Плавание стайэр',
        ],
        [
            'id' => 38,
            'name' => 'Прыжки в воду',
        ],
        [
            'id' => 39,
            'name' => 'Регби',
        ],
        [
            'id' => 40,
            'name' => 'Самбо',
        ],
        [
            'id' => 41,
            'name' => 'Санный спорт',
        ],
        [
            'id' => 42,
            'name' => 'Синхронное плавание',
        ],
        [
            'id' => 43,
            'name' => 'Сноуборд кросс',
        ],
        [
            'id' => 44,
            'name' => 'Сноуборд фристайл',
        ],
        [
            'id' => 45,
            'name' => 'Современное пятиборье',
        ],
        [
            'id' => 46,
            'name' => 'Стрелковый спорт',
        ],
        [
            'id' => 47,
            'name' => 'Теннис',
        ],
        [
            'id' => 48,
            'name' => 'Тяжелая атлетика',
        ],
        [
            'id' => 49,
            'name' => 'Фигурное катание',
        ],
        [
            'id' => 50,
            'name' => 'Фехтование',
        ],
        [
            'id' => 51,
            'name' => 'Футбол',
        ],
        [
            'id' => 52,
            'name' => 'Худ. Гимнастика',
        ],
        [
            'id' => 53,
            'name' => 'Хоккей',
        ],
        [
            'id' => 54,
            'name' => 'Шахматы',
        ],
        [
            'id' => 55,
            'name' => 'Шашки',
        ],
    ];

    const ALLOWED_TEST_VALUES = [0, 1];

    private $sportPointMatrix = [
        //Академическая гребля
        [-10, 0, -10, -30, -20, 0, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, -30, 0, 0],
        //Автоспорт
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, -30, 0, 0, 0],
        //Бадминтон
        [0, -30, -30, 0, 0, 0, -30, -20, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Баскетбол
        [0, -30, -30, 0, 0, -10, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -10, -10, 0, 0, 0, -30, 0, 0],
        //Биатлон
        [0, 0, 0, 0, -20, -30, -30, -20, 0, -10, 0, -10, -10, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Бобслей
        [-10, 0, -10, -30, -20, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, -30, -30, 0, 0],
        //Бокс
        [0, 0, 0, 0, 0, -10, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Борьба вольная
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, -30, -20, 0, -30, -20, 0, 0, -30, 0, 0, 0],
        //Борьба греко-римская
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, -30, 0, 0, 0],
        //Вело спорт шорт трек
        [0, 0, 0, -30, -20, 0, -10, -10, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30],
        //Вело спорт кросс
        [0, 0, 0, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30],
        //Вело спорт кросс кантри
        [-10, -10, 0, 0, -20, -30, -10, -10, 0, -10, 0, -10, -10, -10, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0, 0, 0, -30],
        //Водное поло
        [0, -30, -30, 0, 0, -10, -30, -20, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Воллейбол
        [0, -30, -30, -10, 0, 0, 0, 0, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -10, -10, 0, 0, 0, -30, 0, 0],
        //Гандбол
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Гимнастика
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, -30, -20, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, -30],
        //Гиревой спорт
        [-10, 0, -10, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Горнолыжный спорт слалом
        [0, 0, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, -30, -20, 0, 0, 0, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Гребля на байдарках/каноэ
        [-10, 0, -10, -30, -20, 0, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Дзюдо
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Карате
        [0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Керлинг
        [0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Кикбоксинг
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Конный спорт
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Конькобежный спорт спринт
        [-10, 0, -10, -30, -20, 0, -10, -10, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Конькобежный спорт стайер
        [-10, -10, 0, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Легкая атлетика спринт
        [0, -10, -10, -30, -20, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //легкая атлетика стайер
        [-10, -10, 0, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Метания (молот, ядра, и тд)
        [-10, 0, -10, -30, -20, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30, 0, 0],
        //Прыжки в длину / высоту
        [0, 0, 0, -30, -20, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Лыжный гонки
        [0, 0, 0, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Мини футбол
        [0, 0, 0, 0, -20, -30, -30, -20, 0, -10, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Мото спорт
        [0, 0, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, -30, -20, 0, 0, 0, 0, 0, -30, 0, 0, 0],
        //Настольный теннис
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Парусный спорт
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30, 0, 0, 0],
        //Пауэрлифтинг
        [-10, 0, -10, -30, -20, 0, 0, 0, 0, -10, 0, -10, -10, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Плавание спринт
        [0, -30, -30, -30, -20, 0, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30, 0, 0],
        //плавание стайэр
        [0, -30, -30, 0, -20, -30, -30, -20, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, -30, 0, 0],
        //Прыжки в воду
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, -10, -10, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, -30],
        //Регби
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Самбо
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Санный спорт
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, -10, -10, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Синхронное плавание
        [0, -30, -30, 0, -20, -30, -30, -20, 0, 0, -10, -10, 0, 0, 0, -10, -10, 0, 0, 0, 0, -30, -20, 0, -30, 0, 0, 0, 0],
        //Сноуборд кросс
        [0, 0, 0, -10, 0, 0, 0, 0, 0, -10, 0, -10, 0, 0, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, -30],
        //Сноуборд фристайл
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, -30],
        //Современное пятиборье
        [0, -10, -10, 0, -20, -30, -30, -20, 0, -10, 0, -10, -30, -20, 0, -10, -10, 0, -10, -10, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Стрелковый спорт
        [0, 0, 0, 0, 0, 0, 0, 0, 0, -10, 0, -10, -10, -10, 0, 0, 0, 0, -30, -20, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Теннис
        [0, 0, 0, -10, 0, 0, -30, -20, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Тяжелая атлетика
        [-10, 0, -10, -30, -20, 0, 0, 0, 0, -10, 0, -10, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Фигурное катание
        [-10, -10, 0, -10, 0, 0, -10, -10, 0, 0, -10, -10, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, 0, 0, 0, 0, -30],
        //Фехтование
        [0, -10, -10, -10, 0, 0, 0, 0, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, 0, 0, 0, -30, 20, 0, 0, 0, 0, 0, 0],
        //Футбол
        [0, 0, 0, 0, -20, -30, -30, -20, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -10, -10, 0, 0, 0, 0, 0, 0],
        //Худ. Гимнастика
        [-10, -10, 0, 0, 0, 0, 0, 0, 0, 0, -10, -10, 0, 0, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, 0, 0, 0, 0],
        //Хоккей
        [0, 0, 0, 0, 0, 0, -10, -10, 0, -10, -10, 0, -30, -20, 0, 0, 0, 0, -30, -20, 0, -30, -20, 0, 0, 0, 0, 0, 0],
        //Шахматы
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //Шашки
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ];

    /**
     * @param array $testPoints
     * @return Matrix
     */
    private function _getMatrixResult(array $testPoints): Matrix
    {
        if (count($testPoints) !== 29) {
            throw new InvalidArgumentException("Результат тестов должен быть массивом размерности 29.");
        }

        foreach ($testPoints as $testPoint) {
            if (count($testPoint) !== 1) {
                throw new InvalidArgumentException("Результат единичного теста должен быть массивом размерности 1.");
            }

            if (!in_array($testPoint[0], self::ALLOWED_TEST_VALUES)) {
                throw new InvalidArgumentException("Значение результат единичного теста должен быть значением 0 или 1.");
            }
        }

        $matrix1 = new Matrix($this->sportPointMatrix);
        $matrix2 = new Matrix($testPoints);

        return $matrix1->multiply($matrix2);
    }

    /**
     * @param array $testPoints
     * @return array
     */
    public function getResult(array $testPoints)
    {
        $matrixResult = $this->_getMatrixResult($testPoints);

        $res = [];

        foreach ($matrixResult as $item) {
            $res[] = 100 + (int)$item[0];
        }

        return $res;
    }

    /**
     * @param array $testPoints
     * @return array
     */
    public function getResultWithSportNames(array $testPoints)
    {
        $resultOnlyDigits = $this->getResult($testPoints);

        $res = [];

        foreach ($resultOnlyDigits as $key => $value) {
            $res[] = [
                'name' => $this->getSportById($key),
                'value' => $value,
            ];
        }

        return $res;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getSportById(int $id): array
    {
        if ($id < 0) {
            throw new InvalidArgumentException("Идентификатор спорта должен быть положительным числом.");
        }

        $found = array_filter(self::SPORTS, function ($value) use ($id) {

            return (string)$value['id'] === (string)$id;
        });

        if (empty($found)) {
            throw new RuntimeException(sprintf('Не найден спорт с идентификатором %s', (string)$id));
        }

        if (count($found) > 1) {
            throw new RuntimeException(sprintf('Найдено больше одного вида спорта с идентификатором %s', (string)$id));
        }

        return array_shift($found);
    }

}
