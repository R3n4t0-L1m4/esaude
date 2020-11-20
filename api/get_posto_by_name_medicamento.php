<?php
header('Content-Type: application/json');
require_once '../database/Connection.class.php';

$o = new stdClass;
$o->data = [];

if(count($_GET)){
    $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
    if($nome){
        $sql = "SELECT b.* FROM medicamento a
        LEFT JOIN disponivel c
        ON c.id_medicamento = a.id
        LEFT JOIN posto b
        ON b.id = c.id_posto
        WHERE a.nome = :nome";

        $nome = '%'.$nome.'%';
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        $o->data = $stmt->fetchAll();
    }
}
echo json_encode($o); return;


