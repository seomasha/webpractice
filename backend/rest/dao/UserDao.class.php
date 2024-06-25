<?php

require_once __DIR__ . "/BaseDao.class.php";

class UserDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("items");
    }

    public function addUser($user)
    {
        $this->insert("items", $user);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM items";
        return $this->query($query, []);
    }

    public function getUserByID($id)
    {
        $query = "SELECT * FROM items WHERE id = :id";
        return $this->query_unique($query, ['id' => $id]);
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM items WHERE id = :id";
        $this->execute($query, ['id' => $id]);
    }

    public function editUser($id, $user)
    {
        $query = "UPDATE items SET email = :email, name = :name, category = :category WHERE id = :id";
        $this->execute($query, [
            'id' => $id,
            'email' => $user['email'],
            'name' => $user['name'],
            'category' => $user['category']
        ]);
    }
}
