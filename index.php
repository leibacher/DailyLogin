<?php require_once 'require.php'; ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Daily Reward Bonus</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    </head>
    <body>
<?php
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
    }
?> 
    </body>
</html> 