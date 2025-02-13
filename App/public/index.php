<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\MatrixNeighboursCounter;
use App\Models\MatrixModel;

//Вот тут указать количество желаемых колонок в матрице
$matrix_columns = 5;

//А тут указать количество строк в матрице
$matrix_rows = 5;

//Указать количество соседей больше которых считать
$countNeighboursMoreThen = 2;

$matrixModel = new MatrixModel($matrix_rows, $matrix_columns);
$matrixCounter = new MatrixNeighboursCounter($matrixModel, $countNeighboursMoreThen);

$matrixCounter->countNeighbours();

print_r($matrixCounter->getZeroNeighbours())

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>


</head>
<body>

    <section class = "buttons">
        <button id = "flashZeros" type = "submit">Подсветить цели</button>
        <button id = "zerosInfo" type = "submit">Информационное сообщение</button>
        <button id = "flashOnes" type = "submit">Подсветить соседей</button>
    </section>

    <table data-zeros='<?= json_encode($matrixCounter->getZerosCoordinates()) ?>'
           data-zerosneighbours="<?= json_encode($matrixCounter->getZeroNeighbours())?>">

        <tr>
            <td></td>
            <?php for ($column = 0; $column < $matrixModel->getColumns(); $column++): ?>
                <td><h1 style = "color: green"><?= $column + 1 ?></h1></td>
            <?php endfor; ?>
        </tr>

        <?php for ($row = 0; $row < $matrixModel->getRows(); $row++): ?>
            <tr>
                <td> <h1 style="color : green"><?= $row + 1 ?></h1> </td>
                <?php for ($column = 0; $column < $matrixModel->getColumns(); $column++): ?>
                    <td data-row ="<?= $row ?>" data-col = "<?= $column ?>">
                        <h1><?= $matrixModel->getMatrix()[$row][$column] ?></h1>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

</body>
</html>
