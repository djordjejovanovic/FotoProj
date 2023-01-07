<?php

class User {
    public $id;
    public $email;
    public $username;
    public $password;
    public $usertype;

    public function __construct($user)
    {
        $this->id = $user['user_id'];
        $this->email = $user['user_email'];
        $this->username = $user['user_name'];
        $this->password = $user['user_password'];
        $this->usertype = $user['user_type'];
    }
    public function __destruct()
    {
        $this->id = null;
        $this->email = null;
        $this->username = null;
        $this->password = null;
        $this->usertype = null;
    }

}

?>