<?php

/**
 * Class User
 */
class User
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $email;

    function __construct($id, $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
}