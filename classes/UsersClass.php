<?php

class Users{

    protected string $name;
    protected string $lastName;
    protected string $email;
    protected string $password;
   
    
    protected function __construct(string $name, string $lastName, string $email, string $password)
    {
        $this->name=$name;
        $this->lastName=$lastName;
        $this->email=$email;
        $this->password=$password;

    }

}

?>