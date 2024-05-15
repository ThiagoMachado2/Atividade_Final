<?php 
include 'database.php';

// Query para recuperar os eventos
$query_events = "SELECT id, title, color, start, end FROM events";

$result_events = $conn->prepare($query_events);

$result_events->execute();

$result_set = $result_events->get_result();

// Criando o array que recebe os eventos
$events = [];

// Percorrer a lista de registros retornados do banco de dados
while ($row_events = $result_set->fetch_assoc()) {
    // Adicionar evento ao array de eventos
    $events[] = [
        'id' => $row_events['id'],
        'title' => $row_events['title'],
        'color' => $row_events['color'],
        'start' => $row_events['start'],
        'end' => $row_events['end']
    ];
}

// Codificar o array de eventos em JSON e o imprime
echo json_encode($events);
?>
