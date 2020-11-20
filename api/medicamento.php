<?php
header('Content-Type: application/json');
require_once '../database/Connection.class.php';
if(count($_POST)){
    $nome = isset($_GET['nome']) ? $_GET['nome'] : null;   

    if($nome && $endereco){        
        $sql = "INSERT INTO medicamento (nome) VALUES (:nome)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        
        if($stmt->execute()){
            http_response_code(201); return; //registro criado
        }              
    }

    http_response_code(301); return; //erro ao criar o registro
}else{
    $o = new stdClass;
    $o->data = [];

    if(count($_GET)){
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id){        
            $sql = "SELECT * FROM medicamento WHERE id = :id";
            $stmt = Connection::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $o->data = $stmt->fetch();
        }

    }else{
        $o->data = Connection::query("SELECT * FROM medicamento")->fetchAll();
    }

    echo json_encode($o); return;
}

