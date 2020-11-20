<?php
header('Content-Type: application/json');
require_once '../database/Connection.class.php';

$o = new stdClass;
$o->data = [];

if(count($_GET)){
    $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
    if($nome){        
        $sql = "SELECT * FROM medicamento WHERE a. = :id";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $o->data = $stmt->fetch();
    }

}else{
    $o->data = Connection::query("SELECT * FROM medicamento")->fetchAll();
}

echo json_encode($o); return;


