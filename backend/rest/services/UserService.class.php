<?php

require_once __DIR__ . "/../dao/UserDao.class.php";

class UserService
{
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function addUser($user)
    {
        return $this->userDao->addUser($user);
    }

    public function getUsers()
    {
        $data = $this->userDao->getUsers();
        return $data;
    }

    public function getUserByID($id)
    {
        return $this->userDao->getUserByID($id);
    }

    public function deleteUser($id)
    {
        $this->userDao->deleteUser($id);
    }

    public function editUser($user)
    {
        $id = $user['id'];
        unset($user['id']);

        $this->userDao->editUser($id, $user);
    }
}
