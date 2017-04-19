<?php

class User
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

}