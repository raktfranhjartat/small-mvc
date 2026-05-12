<?php

namespace App\Models;

class UserModel extends BaseModel
{
    
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    // Create Session

    public function createSession($userId, $token, $expires)
    {
        $sql = "INSERT INTO sessions (user_id, token, expires_at) VALUES (?, ?, ?)";
        $this->db->insert($sql, [$userId, $token, $expires]);
    }

    // remove Session

    public function removeSession($token)
    {
        $sql = "DELETE FROM sessions WHERE token = ?";
        $this->db->delete($sql, [$token]);
    }

    // Add User

    public function addUser($email, $password, $name)
    {
        

        $sql = "INSERT INTO " . $this->table . " (email, password_hash, name) VALUES (?, ?, ?)";
        $this->db->insert($sql, [$email, $password, $name]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = ?";
        return $this->db->fetch($sql, [$email]);
    }
    
    // Get Session by Token

    public function getSessionByToken($token)
    {
        $sql = "SELECT * FROM sessions WHERE token = ?";
        return $this->db->fetch($sql, [$token]);
    }
}