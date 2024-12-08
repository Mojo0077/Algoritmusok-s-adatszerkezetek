<?php

// Rekurzív függvény a lehetséges utak számának kiszámítására
function countPaths($grid, $x, $y, $n) {
    // Ha túlmegyünk a rácson, vagy csapdára lépünk, akkor visszatérünk 0-val
    if ($x >= $n || $y >= $n || $grid[$x][$y] === '*') {
        return 0;
    }

    // Ha elértük a célpontot, visszatérünk 1-gyel
    if ($x === $n - 1 && $y === $n - 1) {
        return 1;
    }

    // Rekurzív hívások jobbra és lefelé
    return countPaths($grid, $x + 1, $y, $n) + countPaths($grid, $x, $y + 1, $n);
}

// Fő program
if ($argc < 3) {
    fwrite(STDERR, "Usage: php grid_paths_recursive.php <input_file> <output_file>\n");
    exit(1);
}

$inputFile = $argv[1];
$outputFile = $argv[2];

// Bemenet beolvasása
if (!file_exists($inputFile)) {
    fwrite(STDERR, "Error: Input file '$inputFile' not found.\n");
    exit(1);
}

$input = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$n = intval($input[0]);
$grid = array_slice($input, 1);

// Átalakítás 2D tömbbé
for ($i = 0; $i < $n; $i++) {
    $grid[$i] = str_split($grid[$i]);
}

// Útvonalak számának kiszámítása
$result = countPaths($grid, 0, 0, $n);

// Eredmény kiírása a kimeneti fájlba
if (file_put_contents($outputFile, $result) === false) {
    fwrite(STDERR, "Error: Could not write to output file '$outputFile'.\n");
    exit(1);
}

echo "Result written to $outputFile\n";
