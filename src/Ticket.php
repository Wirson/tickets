<?php

require_once 'connection.php';

class Ticket
{
    const NON_EXISTING_ID = -1;

    private $id;
    private $userId;

    /**
     * User constructor.
     * @param $id
     */
    public function __construct()
    {
        $this->id = self::NON_EXISTING_ID;
        $this->userId = null;
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
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function saveToDB(PDO $conn)
    {
        if ($this->id == self::NON_EXISTING_ID) {

            $stmt = $conn->prepare('INSERT INTO tickets(user_id) VALUES (:user_id)');
            $result = $stmt->execute(
                [
                    'user_id' => $this->userId
                ]
            );

            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        }
    }
}