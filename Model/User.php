<?php
namespace App\Model;

class User extends Database
{
    private $lastname;
    private $firstname;
    private $password;
    private $confirmPassword;
    private $email;
    private $role;
    private $confirmToken;
    private $registDate;

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getConfirmToken()
    {
        return $this->confirmToken;
    }

    public function getRegistDate()
    {
        return $this->registDate;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setConfirmToken($confirmToken)
    {
        $this->confirmToken = $confirmToken;
    }

    public function setRegistDate($registDate)
    {
        $this->registDate = $registDate;
    }

    public function __construct($datas)
    {
        $this->lastname = $datas['lastname'];
        $this->firstname = $datas['firstname'];
        $this->password = $datas['password'];
        $this->confirmPassword = $datas['confirmPassword'];
        $this->email = $datas['email'];
        $this->role = $datas['role'];
        /* voir confirmToken et registDate */
        /* si null ? */
    }

    public function checkEmail()
    {
        $sql = 'SELECT COUNT(email) AS total FROM user WHERE email = ?';
        if ($this->runRequest($sql, array($this->email))->fetch()->total != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertUser()
    {
        $sql = 'INSERT INTO user SET lastname = ?, firstname = ?, password = ?, email = ?, role = ?, confirm_token = ?';
        $insertUser = $this->runRequest($sql, array(
            $this->lastname,
            $this->firstname,
            $this->password,
            $this->email,
            $this->role,
            $this->confirmToken
        ));
        return $insertUser;
    }
}