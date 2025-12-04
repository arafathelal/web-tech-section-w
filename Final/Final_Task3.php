<?php

$linebreak = "<br>";
for ($i = 1; $i <= 20; $i++) {
    echo $i . " ";
    if ($i % 5 == 0) {
        echo "<br>";
    }
}

// echo"While loop......................";
// $d = 0;
// while( $d <= 20 && $d%2== 0) {
//     echo $d . " ";
//     $d+=2;
// }

echo "While loop......................";
$d = 0;
while ($d <= 20) {
    if ($d % 2 == 0) {
        echo $d . " ";
    }
    $d++;
}
echo $linebreak;
echo"Printing fruits array .......... <br>";
$fruits = array("Apple"=>"Red","Banana"=>"Yellow","Grapes"=>"Green");
foreach ($fruits as $fruit => $color) {
    echo "Fruit: ".$fruit." , Color: " .$color."<br>";
}

?>