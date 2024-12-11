<?php

if ($argc < 3) {
    fwrite(STDERR, "Usage: php kirandulas.php <input_file> <output_file>\n");
    exit(1);
}

$inputFile = $argv[1];
$outputFile = $argv[2];

// Bemenet beolvasása
$input = file($inputFile, FILE_IGNORE_NEW_LINES);
list($N, $M, $S) = array_map('intval', explode(' ', $input[0]));

$edges = [];
for ($i = 1; $i <= $M; $i++) {
    $edges[] = array_map('intval', explode(' ', $input[$i]));
}

function kirandulas($N, $start, $edges) {
    // Gráf inicializálása
    $graph = array_fill(1, $N, []);
    foreach ($edges as $edge) {
        $a = $edge[0];
        $b = $edge[1];
        $t = $edge[2];
        $graph[$a][$b] = $t;
        $graph[$b][$a] = $t;
    }

    // Összes város bejárása (teljes permutációk)
    $cities = range(1, $N);
    unset($cities[array_search($start, $cities)]);
    $permutations = permute($cities);
    $minTime = PHP_INT_MAX;
    $bestRoute = [];

    foreach ($permutations as $route) {
        $time = 0;
        $prevCity = $start;
        foreach ($route as $nextCity) {
            if (isset($graph[$prevCity][$nextCity])) {
                $time += $graph[$prevCity][$nextCity];
            } else {
                $time = PHP_INT_MAX;
                break;
            }
            $prevCity = $nextCity;
        }
        if ($time < $minTime) {
            $minTime = $time;
            $bestRoute = $route;
        }
    }

    return [$minTime, $bestRoute];
}

function permute($items, $perms = []) {
    if (empty($items)) {
        return [$perms];
    }
    $result = [];
    for ($i = 0; $i < count($items); $i++) {
        $newItems = $items;
        $newPerms = $perms;
        $newPerms[] = array_splice($newItems, $i, 1)[0];
        $result = array_merge($result, permute($newItems, $newPerms));
    }
    return $result;
}

list($minTime, $route) = kirandulas($N, $S, $edges);

// Kimenet fájlba írása
$output = [];
$output[] = $minTime;
$output[] = implode(' ', array_merge([$S], $route));

file_put_contents($outputFile, implode("\n", $output) . "\n");
?>
