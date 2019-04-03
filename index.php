<?php require_once 'require.php'; ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Daily Reward Bonus</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.min.js"></script>
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
?> 
    </body>
</html> 