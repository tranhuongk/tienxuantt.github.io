<?php
class Student {

    private $name;  
    private $age; 
    private $mssv;  

    public function __construct($name = "xuan", $age = 20, $mssv = "123"){
        $this->name = $name;
        $this->age  = $age;
        $this->mssv = $mssv;
    }
    public function __destruct(){
       $_SESSION[$this->name] = serialize($this);
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getAge(){
        return  $this->age;
    }
    public function setAge($age){
        $this->age  = $age;
    }
    public function getMssv(){
        return  $this->mssv;
    }
    public function setMssv($mssv){
        $this->mssv = $mssv;
    }
}