<?php
class User
{
    private $userID;
    private $name;
    private $surname;
    private $email;
    private $groupID;
    private $group;

    public function __construct($userID, $name, $surname, $email, $groupID, $group)
    {
        $this->userID = $userID;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->groupID = $groupID;
        $this->group = $group;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGroupID()
    {
        return $this->groupID;
    }

    public function setGroupID($groupID)
    {
        $this->groupID = $groupID;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
    }
}
