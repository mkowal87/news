<?php

namespace App\Controller;
/**
 * Created by PhpStorm.
 * User: mkowal
 * Date: 12.06.2019
 * Time: 00:08
 */

use App\Model\UserModel;

/**
 * Class UserController
 *
 * @package App\Controller
 */
class UserController
{


    private $user;

    private $connection;

    public function __construct()
    {
        $config = include($_SERVER['DOCUMENT_ROOT'].'/config.php');


        try{
            $this->connection = new \mysqli($config['host'], $config['user'], $config['password'], $config['name']);
        }catch (\Exception $e){
            echo $e->getMessage() . '<br>' . 'There have been a connection issue';
        }

    }

    /**
     * Method for allowing user to log in
     * @return bool
     */
    public function loginUser() : bool
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = 'SELECT * FROM users 
                WHERE email = "'.$email.'"';

        $query = $this->connection->query($sql);
        $result = $query->fetch_array();

        if ($query->num_rows == 1 && password_verify($password, $result['password']))
        {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['first_name'] = $result['first_name'];
            $_SESSION['last_name'] = $result['last_name'];
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Method for creating new account for user.
     * @return bool
     */
    public function registerUser() : bool
    {

        $sql = 'INSERT 
                INTO users (first_name, last_name, gender, email, password) 
                VALUES (?, ?, ?, ?, ?);';
        $statement = $this->connection->prepare($sql);
        $hashedPassword = password_hash($this->user->getPassword(), PASSWORD_DEFAULT);
        $statement->bind_param('sssss',
            $this->user->getFirstName(),
            $this->user->getLastName(),
            $this->user->getGender(),
            $this->user->getEmail(),
            $hashedPassword
        );

        $query = $statement->execute();

        return $query;
    }

    /**
     * Validating if user already exit in DB, if not creating a model of user
     * that will be used later for creating new user.
     *
     * @param string $email
     * @return bool
     */
    public function isUserExist(string $email) : bool
    {
        $user = $this->connection->query('SELECT * FROM users WHERE email = "'.$email.'"');

        if ($user->num_rows > 0){
            return true;
        }

        $this->setUser();


        return false;
    }

    /**
     * Setting UserModel for later use
     *
     * @return UserModel
     */
    private function setUser() : UserModel
    {

        $user = new UserModel();
        $user
            ->setFirstName($_POST['first_name'])
            ->setLastName($_POST['last_name'])
            ->setEmail($_POST['email'])
            ->setGender($_POST['gender'])
            ->setPassword($_POST['password']);

        $this->user = $user;
    }

    /**
     * @return UserModel
     */
    public function getUser() : UserModel
    {
        return $this->user;
    }

    /**
     * Method to perform logout and destroying session.
     * @return bool
     */
    public static function logout() : bool
    {
        session_destroy();
        unset($_SESSION['login']);
        unset($_SESSION['user_id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        return true;
    }

}