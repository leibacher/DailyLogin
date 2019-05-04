<?php
// Backgroundcolor
$bgColor = "#FAC516";

// The color of the dailylogin bonus color 
$blockColor = "#ffffff";

// Font color in the Bonus
$fontColor = "#ffffff";

// Font color outside the Bonus
$fontColorOut = "#5B2EC7";

//Color of the coming dailybonuses
$blockComing ="#5B2EC7";

//Color of the dailybonus from today
$blockNow = "#FAC516";

//define the name of the coins
$coinsName = "coins";

//The number multiplied by the current serie to calculate the daily coins
$dailybonusMulti = 150;

// Define maximum series
$maxSerie = 5;

// Define minimum series = 0 important
$minserie = 0;


// create a array with the different dailybonuses
while($minserie<$maxSerie){
    $minserie = $minserie + 1;
    $possibleCoins = $minserie * $dailybonusMulti;
    if($minserie==1){
            $reward = array(
        $minserie => $possibleCoins);
    }
    $reward[$minserie] = $possibleCoins;
   
}




?>