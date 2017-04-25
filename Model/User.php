<?php
namespace App\Model;

use \App\Core\Database;

class User extends Database
{
    const BANNED = 0;
    const VISITOR = 10;
    const MEMBER = 20;
    const ADMIN = 50;
    
    private $id;
    private $lastname;
    private $firstname;
    private $password;
    private $confirmPassword;
    private $email;
    private $role;
    private $confirmToken;
    private $registDate;
    private $resetToken;
    private $resetDate;

    public function getId() { return $this->id; }
    public function getLastname() { return $this->lastname; }
    public function getFirstname() { return $this->firstname; }
    public function getPassword() { return $this->password; }
    public function getConfirmPassword() { return $this->confirmPassword; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getConfirmToken() { return $this->confirmToken; }
    public function getRegistDate() { return $this->registDate; }
    public function getResetToken() { return $this->resetToken; }
    public function getResetDate() { return $this->resetDate; }

    public function setId($id) { $this->id = $id; }
    public function setLastname($lastname) { $this->lastname = $lastname; }
    public function setFirstname($firstname) { $this->firstname = $firstname; }
    public function setPassword($password) { $this->password = $password; }
    public function setConfirmPassword($confirmPassword) { $this->confirmPassword = $confirmPassword; }
    public function setEmail($email) { $this->email = $email; }
    public function setRole($role) { $this->role = $role; }
    public function setConfirmToken($confirmToken) { $this->confirmToken = $confirmToken; }
    public function setRegistDate($registDate) { $this->registDate = $registDate; }
    public function setResetToken($resetToken) { $this->resetToken = $resetToken; }
    public function setResetDate($resetDate) { $this->resetDate = $resetDate; }
    
    public function __construct()
    {
        
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    
    public function insertUser()
    {
        $sql = 'INSERT INTO user SET lastname = :lastname, firstname = :firstname, password = :password, email = :email, role = :role, confirmToken = :confirmToken';
        $this->runRequest($sql, array(
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'password' => $this->password,
            'email' => $this->email,
            'role' => $this->role,
            'confirmToken' => $this->confirmToken
        ));
    }

    public function updateUser($params, $id)
    {
        $sql = "UPDATE user SET";
        foreach ($params as $key => $value) {
            $sql = $sql . " $key = :$key,";
        }
        $sql = substr($sql, 0, -1);
        $sql = $sql . " WHERE id = $id";
        $this->runRequest($sql, $params);
    }

    public function checkUser($params)
    {
        $sql = "SELECT id, email, password, lastname, firstname, role, confirmToken, DATE_FORMAT(registDate, '%d-%m-%Y') registDate, resetToken, DATE_FORMAT(resetDate, '%d-%m-%Y') resetDate FROM user WHERE 1 = 1";
        foreach ($params as $key => $value) {
            $sql = $sql . " AND $key = :$key";
        }
        return $this->runRequest($sql, $params)->fetch(\PDO::FETCH_ASSOC);
    }

    public function getUsersMinRole($minRole)
    {
        $sql = "SELECT id, firstname, lastname, role, email FROM user WHERE role >= :minRole";
        return $this->runRequest($sql, array(
            ':minRole' => $minRole
        ))->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUsersMaxRole($maxRole)
    {
        $sql = "SELECT id, firstname, lastname, role FROM user WHERE role <= :maxRole";
        return $this->runRequest($sql, array(
            ':maxRole' => $maxRole
        ))->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function banned()
    {

    }
}