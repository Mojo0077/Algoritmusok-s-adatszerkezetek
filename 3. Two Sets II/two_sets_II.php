<?php
define("MOD", 1000000007);

function countWays($n) {
    $sum = ($n * ($n + 1)) / 2;
    if ($sum % 2 != 0) return 0;

    $target = $sum / 2;
    $dp = array_fill(0, $target + 1, 0);
    $dp[0] = 1;

    for ($i = 1; $i <= $n; $i++) {
        for ($j = $target; $j >= $i; $j--) {
            $dp[$j] = ($dp[$j] + $dp[$j - $i]) % MOD;
        }
    }

    return ($dp[$target] * 500000004) % MOD; // osztás kettővel
}

$inputFile = $argv[1];
$outputFile = $argv[2];

$n = intval(file_get_contents($inputFile));
$result = countWays($n);
file_put_contents($outputFile, $result);
?>
