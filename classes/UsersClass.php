<?php

class Users{

    protected string $name;
    protected string $lastName;
    protected string $email;
    protected string $password;
    protected int $id;
   
    
    public function __construct(string $name, string $lastName, string $email, string $password,int $id=0)
    {
        $this->name=$name;
        $this->lastName=$lastName;
        $this->email=$email;
        $this->password=$password;
        $this->id=$id;



    }

    public function save($pdo){
      
      

      $query = $pdo->prepare("INSERT INTO `users` (`name`, `firstname`, `email`, `password`) VALUES (:name, :firstname, :email, :password)");
      $query->bindValue(":name",  $this->name, PDO::PARAM_STR);
      $query->bindValue(":firstname", $this->lastName, PDO::PARAM_STR);
      $query->bindValue(":email",  $this->email, PDO::PARAM_STR);
      $query->bindValue(":password", $this->password, PDO::PARAM_STR);
  
      return $query->execute();
    }


    public function update ($pdo){

        $query2 = $pdo->prepare("UPDATE users SET `name` =:name , `firstname` =:firstname ,`email`=:email ,`password`=:password WHERE id=:id");
        $query2->bindValue(":name",  $this->name, PDO::PARAM_STR);
        $query2->bindValue(":firstname", $this->lastName, PDO::PARAM_STR);
        $query2->bindValue(":email",  $this->email, PDO::PARAM_STR);
        $query2->bindValue(":password", $this->password, PDO::PARAM_STR);        
        $query2->bindValue(":id", $this->id, PDO::PARAM_INT); 
        return $query2->execute();    
    }
}

?>