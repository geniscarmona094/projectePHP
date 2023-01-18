<?php

class Usuari{

    protected int $idUser=-1;
    protected string $email="";
    protected string $pass="";
    protected ?string $role="";

    public function loadUser($email,$pass,$database)
    {
        
        $sql     = "SELECT * FROM users where email=:email limit 1";
        $dataset = $database->prepare($sql);
        $dataset->execute([':email'=>$email]);

        $row=$dataset?$dataset->fetch(PDO::FETCH_ASSOC):false;

        if($row && $row['pass']==$pass)
        {
          $this->email=$row['email'];
          $this->pass=$row['pass'];
          $this->role=$row['role'];
          $this->idUser=$row['idUser'];
        }
    }

    public function __toString()
    {
        return "IDUsuari: ".$this->idUser." Email: ".$this->email." Pass: ".$this->pass." Role: ".$this->role;
    }

    public function changePass($pass,$email,$database)
    {
        $sql = "UPDATE users SET pass=:pass WHERE email=:email";
        $dataset = $database->prepare($sql);
        $dataset->execute([':pass'=>$pass, ':email'=>$email]);        
    }
}