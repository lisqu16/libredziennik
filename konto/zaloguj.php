<?php

    session_start();

    if (!(isset($_POST['login']))) {
        header("Location: ../login.php");
        exit();
    }

    try {
        require_once "./config.php"; # dane bazy danych

        $connection = @new mysqli($host, $db_user, $db_pass, $db_name); # połączenie z bazą danych
    
        if ($connection->connect_errno!=0) {
            throw new Exception("Wystąpił błąd ".$connection->errno." podczas próby połączenia z bazą danych LibreDziennik.");
        }
    
        $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $pass = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");

        $result = @$connection->query(sprintf("SELECT * FROM users WHERE login='%s'",
    mysqli_real_escape_string($connection, $login))); # wysyłanie zapytania do bazy danych
        if (!$result) {
            throw new Exception("Wystąpił nieoczekiwany błąd podczas wysyłania zapytania do bazy danych LibreDziennik.");
        }
    
        $rows = $result->num_rows;
        if ($rows==0) { # jeżeli nie znaleziono żadnego wyniku w bazie
            throw new Exception("Nieprawidłowy login lub hasło!");
        }

        $data = $result->fetch_assoc(); # pobiera dane znalezionego użytkownika

        # sprawdzanie hasła
        if (!(password_verify($pass, $data['password']))) {
            throw new Exception("Nieprawidłowy login lub hasło!");
        }

        # zapisuje dane w zmiennej sesyjnej
        $_SESSION['logged'] = true;
        $_SESSION['name'] = $data['name'];
        $_SESSION['surname'] = $data['surname'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['deactivated'] = $data['deactivated'];

        $result->free_result(); # wywalanie niepotrzebnych danych

        if($_SESSION['deactivated']==1) {
            throw new Exception("Twoje konto zostało zablokowane przez administratora szkoły!");
        } else {
            header("Location: ../panel/index.php"); # wysyłanie użytkownika do panelu   
        }

    } catch (Exception $e) {
        $_SESSION['given_login'] = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $_SESSION['error'] = $e->getMessage();
        unset($_SESSION['logged']);
        header("Location: ../login.php");
    }

    $connection->close();

?>