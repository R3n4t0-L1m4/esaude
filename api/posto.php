<?php
header('Content-Type: application/json');
require_once '../database/Connection.class.php';
if(count($_POST)){
    $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
    $endereco = isset($_GET['endereco']) ? $_GET['endereco'] : null;

    if($nome && $endereco){        
        $sql = "INSERT INTO posto (nome, endereco) VALUES (:nome, :endereco)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco', $endereco);
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
            $sql = "SELECT * FROM posto WHERE id = :id";
            $stmt = Connection::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $o->data = $stmt->fetch();
        }

    }else{
        $o->data = Connection::query("SELECT * FROM posto")->fetchAll();
    }

    echo json_encode($o); return;
}

