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

        <div id="modal" class="popupContainer" style="display:none;">
				<header class="popupHeader">
						<span class="header_title">Tagesbonus</span>
						<span class="modal_close"><i class="fa fa-times"></i></span>
				</header>
                <span class="modal_close">
				<section class="popupBody">
                    
<?php
                    $counter = 1;
                    while($counter <= $maxSerie){
                        if($serie==$counter){
                            echo '<div style="background-color:yellow;" class="serie">';
                        }else if($serie > $counter){
                            echo '<div style="background-color:black;" class="serie">';
                        }else{
?>
				    <div class="serie">
<?php
                        }
                        echo '<p class="coins">+'.$reward["$counter"].'</p>';                    
?>
                        
                        <p class="coins">Coins</p>
<?php
                        echo '<p class="tag">TAG '.$counter.'</p>';
?>
                    </div>  
<?php
                    $counter++;
                    }          
?>
                    
				</section>
                </span>
                <section class="popupFooter">
                <p>Bereits seit <?php echo $serie; ?> Tag(e) online</p>
                <div class="flexText">
                    <p>Nächster Tagesbonus in </p>
                    <p id="countdown"></p>
                    <p>verfügbar</p>
                </div>
                </section>
		</div>
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