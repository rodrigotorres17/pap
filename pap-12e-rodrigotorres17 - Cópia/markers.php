<?php
header('Content-Type: application/json; charset=utf-8');
// markers.php — devolve marcadores em JSON
$file = __DIR__ . '/markers.json';
if(!file_exists($file)){
  echo json_encode([]);
  exit;
}
$json = file_get_contents($file);
// proteger contra ficheiro vazio / inválido
$data = json_decode($json, true);
if(!is_array($data)) $data = [];
echo json_encode($data, JSON_UNESCAPED_UNICODE);
