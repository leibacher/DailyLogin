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
        $maxSerie = 5;
        $newCoins = $coins + $reward[$newSerie];
        $serieCheck = $serie * 24 * 60 * 60;
        $timeNow = date("U");
        $timestamp = $timeNow - $serieCheck;
        $dateCheck = date("Y-m-d", $timestamp);
        $timestamp = $timeNow + 86400;
        $nextLoginTime = date("d.m.Y", $timestamp); 
        $lastOnline = $user->getLastonline()->format("Y-m-d");
        if($dateCheck == $lastOnline OR $serie==0){
            
            $serie = $newSerie;
            require_once'dailyoverview.php'; 
            $user->setSerie($newSerie);
            $user->setCoins($newCoins);
            $user->save(); 
        }else if($dateCheck < $lastOnline){
            echo "Komm morgen wieder schon genommen!";
        }else{ 
            
             $serie = 1;
            require_once'dailyoverview.php'; 
            $newCoins = $coins + 100;
            $timeNow = date("Y-m-d");
            $user->setSerie(1);
            $user->setCoins($newCoins);
            $user->setLastonline(new DateTime($timeNow));
            $user->save(); 
?>
        <div id="modal" class="popupContainer" style="display:none;">
				<header class="popupHeader">
						<span class="header_title">Tagesbonus</span>
						<span class="modal_close"><i class="fa fa-times"></i></span>
				</header>

				<section class="popupBody">
						<!-- Social Login -->


				</section>
		</div>
<?php
        }
    }


?>


<a href="#modal" class="btn" id="modal_trigger"></a>


<script>
$(document).ready(function() {
   $('#modal_trigger').click();
  });  
    
$("#modal_trigger").leanModal({
		top: 100,
		overlay: 0.6,
		closeButton: ".modal_close"
});
</script>