<?php
    if(isset( $_SESSION['user'])){
        require_once'scripts/countdown.php'; 
        $user = new User($_SESSION['user']);
        $username = $user->getUsername();
        $coins = $user->getCoins();
        $serie = $user->getSerie();
        $newSerie = $serie + 1;
        $reward = array(
            "1" => 100,
            "2" => 200,
            "3" => 400,
            "4" => 600,
            "5" => 900);
        $newCoins = $coins + $reward[$newSerie];
        $serieCheck = $serie * 24 * 60 * 60;
        $timeNow = date("U");
        $timestamp = $timeNow - $serieCheck;
        $dateCheck = date("Y-m-d", $timestamp);
        $timestamp = $timeNow + 86400;
        $nextLoginTime = date("d.m.Y", $timestamp); 
        $lastOnline = $user->getLastonline()->format("Y-m-d");
        if($dateCheck == $lastOnline){
            echo "serie kann weiter gehen! +100";
            $user->setSerie($newSerie);
            $user->setCoins($newCoins);
            $user->save(); 
        }else if($dateCheck < $lastOnline){
            echo "Komm morgen wieder schon genommen!";
        }else{ 
            echo "Verpasst neustart";
            $newCoins = $coins + 100;
            $timeNow = date("Y-m-d");
            $user->setSerie(1);
            $user->setCoins($newCoins);
            $user->setLastonline(new DateTime($timeNow));
            $user->save(); 
        }
    }
?>
<p id="demo"></p>

