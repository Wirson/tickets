<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'connection.php';

use Nassau\PESEL\PESEL;

class User
{
    const NON_EXISTING_ID = -1;

    private $id = self::NON_EXISTING_ID;
    private $email;
    private $name;
    private $pesel;
    private $tickets;

    /**
     * User constructor.
     * @param $id
     * @param $email
     * @param $name
     * @param $pesel
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * @param mixed $pesel
     */
    public function setPesel($pesel)
    {
        $number = new PESEL($pesel);

        $this->pesel = $number->getNumber();
    }

    /**
     * @return mixed
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @param mixed $tickets
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

    public function saveToDB(PDO $conn)
    {
        if ($this->id == self::NON_EXISTING_ID) {

            $stmt = $conn->prepare('INSERT INTO users(email, name, pesel, tickets) VALUES (:email, :name, :pesel, :tickets)');
            $result = $stmt->execute(
                [
                    'email' => $this->email,
                    'name' => $this->name,
                    'pesel' => $this->pesel,
                    'tickets' => $this->tickets
                ]
            );

            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        }
    }

    public static function checkTicketsCount(PDO $conn)
    {
        $count = '';
        $result = $conn->query('SELECT tickets FROM users');
        if ($result !== false) {
            foreach ($result as $tickets) {
                $count += $tickets['tickets'];
            }
        }
        return $count < 10 ? true : false;
    }

    public static function loadAll(PDO $conn)
    {
        $ret = [];
        $result = $conn->query('SELECT * FROM users');
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->email = $row['email'];
                $loadedUser->name = $row['name'];
                $loadedUser->pesel = $row['pesel'];
                $loadedUser->tickets = $row['tickets'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }
}