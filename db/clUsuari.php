<?php
    //password_hash('1111',PASSWORD_DEFAULT);
class Usuari{

    protected int $idUser=-1;
    protected string $username="";
    protected string $pass="";
    protected ?string $role="";

    public function loadUser($username,$pass,$database)
    {
        
        $sql     = "SELECT * FROM users where username=:username limit 1";
        $dataset = $database->prepare($sql);
        $dataset->execute([':username'=>$username]);

        $row=$dataset?$dataset->fetch(PDO::FETCH_ASSOC):false;

        if($row && password_verify($row['passHash'],$pass))
        {
          $this->email=$row['email'];
          $this->pass=$row['passHash'];
          $this->idUser=$row['iduser'];
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