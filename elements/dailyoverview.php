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
                            echo '<div style="background-color:#FAC516;" class="serie">';
                        }else if($serie > $counter){
                            echo '<div class="serie">';
                            echo '<div style="background-image:url(../img/bgtrue.png); background-color:rgba(0,0,0,0);position: absolute;" class="serie seriebox">';
                            echo '</div>';
                            
                        }else{
?>
				    <div class="serie">
<?php
                        }
                        echo '<p class="coins">+'.$reward["$counter"].'</p>';                    
?>
                        
                        <p class="coins text">Coins</p>
<?php
                        echo '<p class="tag">TAG '.$counter.'</p>';
?>
                    </div>  
<?php
                    if($serie > $counter){
                            
                    }
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