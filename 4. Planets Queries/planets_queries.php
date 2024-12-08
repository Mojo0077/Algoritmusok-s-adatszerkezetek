<?php

if ($argc < 3) {
    fwrite(STDERR, "Usage: php planets_queries_I.php <input_file> <output_file>\n");
    exit(1);
}

$inputFile = $argv[1];
$outputFile = $argv[2];

$input = file($inputFile, FILE_IGNORE_NEW_LINES);
list($n, $q) = explode(' ', $input[0]);
$next = array_map('intval', explode(' ', $input[1]));

// Ellenőrzés: érvényes teleportációs célpontok
foreach ($next as $key => $value) {
    if ($value < 1 || $value > $n) {
        fwrite(STDERR, "Invalid destination in 'next' array at position $key: $value\n");
        exit(1);
    }
}

// Előfeldolgozás: ciklusok meghatározása
$visited = array_fill(0, $n, false);
$cycle_start = array_fill(0, $n, -1);
$cycle_length = array_fill(0, $n, -1);

for ($i = 0; $i < $n; $i++) {
    if ($visited[$i]) {
        continue;
    }

    $path = [];
    $current = $i;
    while (!$visited[$current]) {
        $visited[$current] = true;
        $path[] = $current;
        $current = $next[$current] - 1;
    }

    $cycle_start_index = array_search($current, $path);
    if ($cycle_start_index !== false) {
        $cycle_length_value = count($path) - $cycle_start_index;
        for ($j = $cycle_start_index; $j < count($path); $j++) {
            $cycle_start[$path[$j]] = $current;
            $cycle_length[$path[$j]] = $cycle_length_value;
        }
    }
}

// Lekérdezések feldolgozása
$output = [];
for ($i = 2; $i < count($input); $i++) {
    list($x, $k) = explode(' ', $input[$i]);
    $x = $x - 1;

    while ($k > 0 && $cycle_length[$x] === -1) {
        $x = $next[$x] - 1;
        $k--;
    }

    if ($k > 0) {
        $remaining_steps = $k % $cycle_length[$x];
        for ($j = 0; $j < $remaining_steps; $j++) {
            $x = $next[$x] - 1;
        }
    }

    $output[] = $x + 1;
}

// Eredmények kiírása
file_put_contents($outputFile, implode("\n", $output) . "\n");

