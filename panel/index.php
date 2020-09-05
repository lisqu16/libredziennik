<?php
    session_start();
    if (!(isset($_SESSION['logged']))) {
        header("Location: ../login.php");
        exit();
    }
    echo "Jesteś zalogowany jako ".$_SESSION['name']." ".$_SESSION['surname'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreDziennik</title>
</head>
<body>
    
</body>
</html>