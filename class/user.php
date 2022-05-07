<?php

class User {
    private $idUser, $userName,$userPassword,$dateRegister;

    public function __toString(){
        return json_encode([
            "idUser"        =>$this->getIdUser(),
            "userName"      =>$this->getUserName(),
            "userPassword"  =>$this->getUserPassword(),
            "dateRegister"  =>$this->getDateRegister()->format("d/m/Y H:i:s"),
        ]);
    }

    //GETTERS ========================================================
    public function getIdUser       (){return $this->idUser;      }
    public function getUserName     (){return $this->userName;    }
    public function getUserPassword (){return $this->userPassword;}
    public function getDateRegister (){return $this->dateRegister;}
    
    //SETTERS ========================================================
    public function setIdUser       ($setValue){$this->idUser = $setValue;      }
    public function setUserName     ($setValue){$this->userName = $setValue;    }   
    public function setUserPassword ($setValue){$this->userPassword = $setValue;}
    public function setDateRegister ($setValue){$this->dateRegister = $setValue;}

    public function loadById($id){
        $db = new Sql();

        $results = $db->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID",[
            ":ID"=>$id
        ]);

        if (count($results)>0) {
            $row = $results[0];

            $this->setIdUser($row["idusuario"]);
            $this->setUserName($row["deslogin"]);
            $this->setUserPassword($row["dessenha"]);
            $this->setDateRegister(new DateTime($row["dtcadastro"]));

        }
    }
}
