<?php
// Ellenőrzi, hogy adott idő alatt legyártható-e a kívánt termékszám
function canProduceInTime($machines, $time, $requiredProducts) {
    $total = 0;
    foreach ($machines as $machine) {
        $total += floor($time / $machine);
        if ($total >= $requiredProducts) {
            return true;
        }
    }
    return false;
}

// Bináris keresés a minimális idő megtalálására
function findMinimumTime($machines, $requiredProducts) {
    $left = 1; // Minimális idő
    $right = PHP_INT_MAX; // Maximális idő
    $result = $right;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);

        if (canProduceInTime($machines, $mid, $requiredProducts)) {
            $result = $mid; // Ha elég terméket tudunk gyártani
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }
    return $result;
}

// Bemeneti és kimeneti fájlok megadása argumentumként
$inputFile = $argv[1];
$outputFile = $argv[2];

// Fájl megnyitása olvasásra
$input = fopen($inputFile, 'r');
fscanf($input, "%d %d", $n, $t); // Első sor: gépek száma és termékszám
$machines = array_map('intval', explode(' ', trim(fgets($input))));
fclose($input);

// Minimális idő kiszámítása
$result = findMinimumTime($machines, $t);

// Eredmény mentése a kimeneti fájlba
file_put_contents($outputFile, $result . PHP_EOL);
?>
