document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector("table");

    const buttonFlashZeros = document.getElementById("flashZeros");
    const buttonFlashOnes = document.getElementById("flashOnes");
    const buttonZerosInfo = document.getElementById("zerosInfo");

    const zeroCoordinates = JSON.parse(table.dataset.zeros || "[]");
    const zeroNeighboursCoordinates = JSON.parse(table.dataset.zerosneighbours || "[]")
    console.log(zeroNeighboursCoordinates);

    let isZerosFlashed = false;
    let isZerosNeighboursFlashed = false;

    buttonFlashZeros.addEventListener("click", function () {
        isZerosFlashed = !isZerosFlashed;

        zeroCoordinates.forEach(([row, col]) => {
            const cell = document.querySelector(`td[data-row='${row}'][data-col='${col}']`);
            if (cell) {
                cell.style.backgroundColor = isZerosFlashed ? "yellow" : "";
            }
        });
    });

    buttonFlashOnes.addEventListener("click", function() {
        isZerosNeighboursFlashed = !isZerosNeighboursFlashed;

        zeroNeighboursCoordinates.forEach(neighbours => {
            neighbours.forEach(([row, col]) => {
                const cell = document.querySelector(`td[data-row='${row}'][data-col='${col}']`);
                if (cell) {
                    cell.style.backgroundColor = isZerosNeighboursFlashed ? "red" : "";
                }
            });
        });
    });


    buttonZerosInfo.addEventListener("click", function(){

        alert("Количество нулей с заданным количеством соседей " + zeroCoordinates.length);

    })
});
