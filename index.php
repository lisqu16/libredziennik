<?php
    require_once "./config.php";
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style/login.css">
    <title>LibreDziennik</title>
</head>
<body>
    <div id="container">
        <div id="loginData">
            <input type="text" id="username"></input> <br />
            <input type="password" id="password"></input>
        </div>
        <div id="footer">
                <a href="https://github.com/lisqu16">lisqu16</a>, <a href="https://github.com/programistazpolski">ProgramistaZpolski</a> &copy; 2020
                <br/>Konta LibreDziennik v.<?php echo $accVer; ?>
        </div>
    </div>
</body>
</html>