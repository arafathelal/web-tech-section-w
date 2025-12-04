<?php
$temperature = 25;
$linebreak = "<br>";
if ($temperature < 10) {
    echo "It's cold";
} else if ($temperature >= 10 && $temperature <= 25) {
    echo "It's warm";
} else {
    echo "It's hot";
}

echo $linebreak;

$day = 7;
switch ($day) {
    case 1:
        echo "Saturday";
        break;
    case 2:
        echo "Sunday";
        break;
    case 3:
        echo "Monday";
        break;
    case 4:
        echo "Tuesday";
        break;
    case 5:
        echo "Wedensday";
        break;
    case 6:
        echo "Thursday";
        break;
    case 7:
        echo "Friday";
        break;
    default:
        echo "Doomsday";
}
?>