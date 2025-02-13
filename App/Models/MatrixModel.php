<?php

namespace App\Models;

class MatrixModel {

    protected array $matrix;

    protected int $matrix_rows;

    protected int $matrix_columns;

    public function __construct(int $matrix_columns, int $matrix_rows) {

        $this->matrix_columns = $matrix_columns;
        $this->matrix_rows = $matrix_rows;

        for ($i = 0; $i < $matrix_rows; $i++) {
            for ($j = 0; $j < $matrix_columns; $j++) {
                $this->matrix[$i][$j] = rand(0, 1);
            }
        }
    }

    /**
     * Возвращает сформированную матрицу
     * @return array
     */
    public function getMatrix(): array {
        return $this->matrix;
    }
    /**
     * Возвращает количество строк в матрице
     * @return int
     */
    public function getRows(): int {
        return $this->matrix_rows;
    }

    /**
     * Возвращает количество колонок в матрице
     * @return int
     */
    public function getColumns(): int {
        return $this->matrix_columns;
    }

    /**
     * Возвращает левого соседа
     * @param int $row
     * @param int $column
     * @return int
     */
    public function getLeftNeighbor(int $row, int $column): int {
        if ($column === 0){
            return 0;
        }

        return $this->matrix[$row][$column-1];
    }

    /**
     * Возвращает правого соседа
     * @param int $row
     * @param int $column
     * @return int
     */
    public function getRightNeighbor(int $row, int $column): int {
        if ($column === $this->matrix_columns-1){
            return 0;
        }

        return $this->matrix[$row][$column+1];
    }

    /**
     * Возвращает верхнего соседа
     * @param int $row
     * @param int $column
     * @return int
     */
    public function getTopNeighbor(int $row, int $column): int {
        if ($row === 0){
            return 0;
        }

        return $this->matrix[$row-1][$column];
    }

    /**
     * Возвращает нижнего соседа
     * @param int $row
     * @param int $column
     * @return int
     */
    public function getUnderNeighbour(int $row, int $column): int {
        if ($row === $this->matrix_rows-1){
            return 0;
        }
        return $this->matrix[$row+1][$column];
    }

    /**
     * Вывести матрицу в читаемом виде (DEV)
     * @return void
     */
    public function displayMatrix(): void {
        foreach ($this->matrix as $row) {
            echo implode(' ', $row) . PHP_EOL;
        }
    }
}





