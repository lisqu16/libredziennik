<?php
    session_start();

    if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true)) {
        header("Location: ./panel/index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreDziennik</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="center">
        <h1 style="font-size: 45px;">Zaloguj się</h1>
        <div id="firstshow">
            <form action="./konto/zaloguj.php" method="POST">
            <div class="form__group">
                <input type="text" class="form__input" id="login" name="login" placeholder="Login" required <?php
                    if (isset($_SESSION['given_login'])) {
                        echo "value=\"".$_SESSION['given_login']."\"";
                        unset($_SESSION['given_login']);
                    }
                ?>/>
            </div><br>
            <div class="form__group">
                <input type="password" class="form__input" id="password" name="password" placeholder="Hasło" required />
            </div>
            <div class="form__group error">
                <?php
                    if(isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </div>
        </div>
        <div id="buttons">
            <button class="button">Zaloguj</button><br><br>
            </form>
        <a href="">Zresetuj hasło </a>
        </div>
    </div>
    <footer>LibreDziennik &copy; 2020<br>Obraz <a
            href="https://pixabay.com/pl/users/iniesta44-4560761/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4970081">
            Patrik Houštecký</a> z <a
            href="https://pixabay.com/pl/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4970081">
            Pixabay</a></footer>
    <script src="script.js"></script>
</body>

</html>