<?php

require 'data/db_config.php';

class VisitorService
{
    private $dbConfig = null;

    public function __construct()
    {
        $this->dbConfig = new DbConfig();
    }

    public function GetVisitorById($id)
    {
        $visitor = $this->dbConfig->GetSingle(
            "select * from visitors where id = $id"
        );

        return $visitor;
    }

    public function GetAllVisitors()
    {
        $visitors = $this->dbConfig->GetAll(
            "select * from visitors"
        );

        return $visitors;
    }

    public function GetVisitorsByFilter($q)
    {
        $query = "select * from visitors where ";

        if(isset($q))
            $query .= "name like '%$q%' or surname like '%$q%' or TC like '%$q%' ";
        
        $visitors = $this->dbConfig->GetAll($query);

        return $visitors;
    }

    public function AddOrEdit($visitor)
    {
        if(isset($visitor["Id"]))
        {
            $result = $this->dbConfig->ExecuteQuery(
                "update visitors set 
                    TC = '" . $visitor["TC"] . "',
                    Name = '" . $visitor["Name"] . "',
                    Surname = '" . $visitor["Surname"] . "',
                    Phone = '" . $visitor["Phone"] . "',
                    VisitReason = '" . $visitor["VisitReason"] . "' where Id = " . $visitor["Id"]
            );

            if($result)
                $_SESSION["result"] = array("isSuccess" => true, "message" => "Ziyaretçi güncelleme işlemi başarılı.");
            else
                $_SESSION["result"] = array("isSuccess" => false, "message" => "Ziyaretçi güncelleme sırasında hata oluştu.");
        }
        else
        {
            $result = $this->dbConfig->ExecuteQuery(
                "insert into visitors(TC, Name, Surname, Phone, VisitReason) values(
                    '" . $visitor["TC"] . "',
                    '" . $visitor["Name"] . "',
                    '" . $visitor["Surname"] . "',
                    '" . $visitor["Phone"] . "',
                    '" . $visitor["VisitReason"] . "'
                )"
            );

            if($result)
                $_SESSION["result"] = array("isSuccess" => true, "message" => "Ziyaretçi ekleme işlemi başarılı.");
            else
                $_SESSION["result"] = array("isSuccess" => false, "message" => "Ziyaretçi ekleme sırasında hata oluştu.");
        }
    }

    public function DeleteVisitor($id)
    {
        $visitor = $this->GetVisitorById($id);
        
        if($visitor)
        {
            $deletedVisitor = $this->dbConfig->ExecuteQuery(
                "delete from visitors where id ='$id'"
            );

            if($deletedVisitor)
                $_SESSION["result"] = array("isSuccess" => true, "message" => "Ziyaretçi silme işlemi başarılı.");
            else
                $_SESSION["result"] = array("isSuccess" => true, "message" => "Ziyaretçi silme işlemi sırasında hata oluştu.");
        }
    }
}

?>