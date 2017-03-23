<?php
namespace App\Model;

class User extends \App\Core\Database
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
        $sql = 'INSERT INTO user SET lastname = ?, firstname = ?, password = ?, email = ?, role = ?, confirmToken = ?';
        $this->runRequest($sql, array(
            $this->lastname,
            $this->firstname,
            $this->password,
            $this->email,
            $this->role,
            $this->confirmToken
        ));
        $this->id = $this->getLastInsertId();
    }
    
    public function updateUser()
    {
        $sql = "UPDATE user SET confirmToken = ?, role = ?, registDate = NOW() WHERE id = ?";
        $this->runRequest($sql, array(
            $this->confirmToken,
            $this->role,
            $this->id
        ));
    }

    public function checkUser($params)
    {
        $sql = "SELECT * FROM user WHERE 1 = 1";
        foreach ($params as $key => $value) {
            $sql = $sql . " AND $key = :$key";
        }
        return $this->runRequest($sql, $params)->fetch(\PDO::FETCH_ASSOC);
    }
    
}