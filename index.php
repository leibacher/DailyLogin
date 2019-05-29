<?php require_once 'require.php'; ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Daily Reward Bonus</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    </head>
    <body>
<?php
/* show registration message */

if(isset($_GET["message"])){
    if($_GET["message"]==1){
?>
        <div id="correct" class="welcome">
            <p style="color:white;">Erfolgreiche Registration, du kannst dich anmelden!</p>
        </div>    
<?php
    }
}
        
/* include the correct page */
    if(isset($_GET["p"])){
        if($_GET["p"]=="register"){
            require_once'elements/registration.php'; 
        }
    }else{
        require_once'elements/login.php'; 
    } 
    if(isset( $_SESSION['user'])){
        require_once'elements/dailybonus.php'; 
        require_once'elements/minigame.php'; 
    }
        
    if(isset($_GET["loginbonus"])){
        require_once'elements/dailyoverview.php';
    }
?> 
    </body>
</html>
<script>
//after the registration there is a welcome. It fadeout after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('.welcome').fadeOut('2000');
            }, 5000);
        });
</script>
