<?php
/**
 * 
 * 1 - verificar se existe o medicamento cadastrado
 * 2 - verificar se existe o posto cadastrado
 * 3 - inserir registro
 */

<?php
header('Content-Type: application/json');
require_once '../database/Connection.class.php';
if(count($_POST)){

    $id_medicamento = isset($_GET['id_medicamento']) ? $_GET['id_medicamento'] : null;   
    $id_posto = isset($_GET['id_posto']) ? $_GET['id_posto'] : null;   
    $quantidade = isset($_GET['quantidade']) ? $_GET['quantidade'] : null;   

    if($id_medicamento && $id_posto && $qtd){
        
        $sql = "INSERT INTO disponivel (id_medicamento, id_posto, quantidade) 
        VALUES (:id_medicamento, :id_posto, :quantidade)";
        $stmt = Connection::prepare($sql);
        $stmt->bindParam(':id_medicamento', $id_medicamento);
        $stmt->bindParam(':id_posto', $id_posto);
        $stmt->bindParam(':quantidade', $quantidade);
        
        if($stmt->execute()){
            http_response_code(201); return; //registro criado
        }              
    }

    

    http_response_code(301); return; //erro ao criar o registro
}


