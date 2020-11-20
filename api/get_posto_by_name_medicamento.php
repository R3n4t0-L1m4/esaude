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
        ON c.medicamento_id = a.id_medicamento
        LEFT JOIN posto b
        ON b.id_posto = c.posto_id
        WHERE a.nome_medicamento LIKE :nome";
        $nome = '%'.$nome.'%';
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();
        $o->data = $stmt->fetchAll();
    }
}
echo json_encode($o); return;


