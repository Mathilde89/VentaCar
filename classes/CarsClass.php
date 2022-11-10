<?php

class Cars{
    protected string $model;
    protected int $powerful;
    protected int $year;
    protected string $description;
    protected int $users_id;
    

    public function __construct(string $model, int $powerful, int $year, string $description,int $users_id)
    {
        $this->model=$model;
        $this->powerful=$powerful;
        $this->year=$year;
        $this->description=$description;
        $this->users_id=$users_id;
    }

    public function saveCard($pdo){

        
        $query5 = $pdo->prepare("INSERT INTO `cars`(`model`, `powerful`, `year`, `description`,`user_id`) VALUES (:model,:powerful,:annee,:description,:users_id)");
        $query5->bindValue(":model", $this->model, PDO::PARAM_STR);
        $query5->bindValue(":powerful", $this->powerful, PDO::PARAM_INT);
        $query5->bindValue(":annee",$this->year, PDO::PARAM_INT);
        $query5->bindValue(":description", $this->description, PDO::PARAM_STR);
        $query5->bindValue(":users_id", $this->users_id,PDO::PARAM_INT);
        var_dump($query5);
        return $query5->execute();
    }



    

}

?>