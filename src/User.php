<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Nassau\PESEL\PESEL;

class User
{
    const NON_EXISTING_ID = -1;

    private $id;
    private $email;
    private $name;
    private $pesel;

    /**
     * User constructor.
     * @param $id
     * @param $email
     * @param $name
     * @param $pesel
     */
    public function __construct()
    {
        $this->id = self::NON_EXISTING_ID;
        $this->email = '';
        $this->name = '';
        $this->pesel = '';
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
}