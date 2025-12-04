<?php

function addition($a, $b) {
    echo  $a + $b . "<br>"; 
}

addition(2,4);
addition(3.5, 2);

function factorial($n) {
    if ($n == 0 || $n == 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

echo factorial (3) . "<br>";


function prime($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return "Prime number";
}

echo prime(7);

?>