<?php
require_once 'src/User.php';
require_once 'src/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (User::checkTicketsCount($conn)) {
        if (!empty($_POST['name'])) {
            $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        }
        if (!empty($_POST['email'])) {
            $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        } else {
            return 'Wrong E-mail';
        }
        if (!empty($_POST['pesel'])) {
            $pesel = trim(filter_input(INPUT_POST, 'pesel'));
        }
        if (is_numeric($_POST['tickets']) && $_POST['tickets'] <= 3) {
            $tickets = $_POST['tickets'];
        } else {
            echo 'You can buy at most 3 tickets';
        }
        $user = new User();

        var_dump($_POST);
        if (isset($name)) {
            $user->setName($name);
        }

        if (isset($email)) {
            $user->setEmail($email);
        }

        if (isset($pesel)) {
            try {
                $user->setPesel($pesel);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if (isset($tickets)) {
            $user->setTickets($tickets);
        }
        $user->saveToDB($conn);
        echo $user->getTickets() . ' tickets sent to: ' . $user->getEmail();
    } else {
        echo 'All tickets sold!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
</head>
<body>
<form action="" method="post">
    <label>Your name:
        <input type="text" name="name">
    </label>
    <label>Your E-mail:
        <input type="email" name="email">
    </label>
    <label>Your Pesel:
        <input type="text" name="pesel">
    </label>
    <label>Ticket count:
        <input type="number" min="1" max="3" name="tickets">
    </label>
    <input type="submit" value="submit">
</form>
<a href="admin.php"><button>Admin</button></a>
</body>
</html>