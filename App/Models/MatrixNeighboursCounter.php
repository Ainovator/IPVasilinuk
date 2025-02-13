<?php

namespace App\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

class MatrixNeighboursCounter
{
    /**
     * Объект матрицы
     * @var MatrixModel
     */
    private MatrixModel $matrixModel;

    /**
     * Количество нулей с соседями больше, чем задано
     * @var int
     */
    private int $zerosWithNeighbours = 0;

    /**
     * Количество соседей больше которых вести подсчёт
     * @var int
     */
    private int $moreNeighboursThen = 0;

    /**
     * Координаты найденных нулей в матрице
     * @var array
     */
    private array $coordinatesZeros = [];

    /**
     * Координаты единиц, которые являются соседями найденного нуля
     * @var array
     */
    private array $coordinatesNeighbours = [];

    public function __construct(MatrixModel $matrixModel, int $targetNeighbours)
    {
        $this->matrixModel = $matrixModel;
        $this->moreNeighboursThen = $targetNeighbours;
    }

    /**
     * Подсчитывает количество нулей у которых больше targetNeighbours соседей единиц
     * @return self
     */
    public function countNeighbours(): self
    {
        $rows = $this->matrixModel->getRows();
        $columns = $this->matrixModel->getColumns();
        $matrix = $this->matrixModel->getMatrix();

        for ($row = 0; $row < $rows; $row++) {
            for ($column = 0; $column < $columns; $column++) {

                if ($matrix[$row][$column] !== 0) {
                    continue;
                }

                $counter = 0;
                $neighboursOnes = [];

                if ($row > 0 && $matrix[$row - 1][$column] === 1) {
                    $counter++;
                    $neighboursOnes[] = [$row - 1, $column];
                }

                if ($column > 0 && $matrix[$row][$column - 1] === 1) {
                    $counter++;
                    $neighboursOnes[] = [$row, $column - 1];
                }

                if ($column < $columns - 1 && $matrix[$row][$column + 1] === 1) {
                    $counter++;
                    $neighboursOnes[] = [$row, $column + 1];
                }

                if ($row < $rows - 1 && $matrix[$row + 1][$column] === 1) {
                    $counter++;
                    $neighboursOnes[] = [$row + 1, $column];
                }

                if ($counter > $this->moreNeighboursThen) {
                    $this->zerosWithNeighbours++;
                    $this->coordinatesZeros[] = [$row, $column];
                    $this->coordinatesNeighbours[] = $neighboursOnes;
                }
            }
        }
        return $this;
    }


    /**
     * Возвращает координаты нулей
     * @return array
     */
    public function getZerosCoordinates(): array
    {
        return $this->coordinatesZeros;
    }

    /**
     * Возвращает количество нулей с заданным количеством соседей
     * @return int
     */
    public function getZerosWithNeighbours(): int
    {
        return $this->zerosWithNeighbours;
    }

    /**
     * Возвращает список координат единиц которые являются соседями найденного нуля
     * @return array
     */
    public function getZeroNeighbours(): array{
        return $this->coordinatesNeighbours;
    }
}
