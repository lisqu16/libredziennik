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
    
        $login = $_POST['login'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM users WHERE login='$login' AND password='$pass'";

        $result = @$connection->query($sql); # wysyłanie zapytania do bazy danych
        if (!$result) {
            throw new Exception("Wystąpił nieoczekiwany błąd podczas wysyłania zapytania do bazy danych LibreDziennik.");
        }
    
        $rows = $result->num_rows;
        if ($rows==0) { # jeżeli nie znaleziono żadnego wyniku w bazie
            throw new Exception("Nieprawidłowy login lub hasło!");
        }

        $_SESSION['logged'] = true;

        $data = $result->fetch_assoc(); # pobiera dane znalezionego użytkownika
        $_SESSION['name'] = $data['name'];
        $_SESSION['surname'] = $data['surname'];
        $_SESSION['email'] = $data['email'];

        $result->free_result(); # wywalanie niepotrzebnych danych

        header("Location: ../panel/index.php"); # wysyłanie użytkownika do panelu

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../login.php");
    }

    $connection->close();

?>