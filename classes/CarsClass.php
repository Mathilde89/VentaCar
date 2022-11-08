<?php

class Cars{
    protected string $model;
    protected int $powerful;
    protected int $year;
    protected string $description;
    // userID?

    protected function __construct(string $model, int $powerful, int $year, string $description)
    {
        $this->model=$model;
        $this->powerful=$powerful;
        $this->year=$year;
        $this->description=$description;
    }
}

?>