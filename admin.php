<?php
require_once 'src/User.php';
require_once 'src/connection.php';

function drawTable($conn)
{
    $users = User::loadAll($conn);
    foreach ($users as $user) {
        echo '<tr><td>' . $user->getName() . '</td>
                <td>' . $user->getEmail() . '</td>
                <td>' . $user->getPesel() . '</td>
                <td>' . $user->getTickets() . '</td></tr>';
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
<a href="index.php">
    <button>Back to main page</button>
</a>
<div>
    <table>
        <thead>
        <tr>
            <th>Imię</th>
            <th>E-mail</th>
            <th>PESEL</th>
            <th>Bilety</th>
        </tr>
        </thead>
        <tbody>
        <?php
        drawTable($conn);
        ?>
        </tbody>
    </table>
</div>

</body>
</html>