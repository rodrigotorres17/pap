<?php
// save_marker.php — recebe POST JSON e acrescenta a markers.json
header('Content-Type: application/json; charset=utf-8');
$raw = file_get_contents('php://input');
$payload = json_decode($raw, true);
if(!$payload) {
  echo json_encode(['success'=>false, 'error'=>'JSON inválido']);
  exit;
}
// validação básica
$name = trim($payload['name'] ?? '');
$desc = trim($payload['desc'] ?? '');
$lat = floatval($payload['lat'] ?? 0);
$lng = floatval($payload['lng'] ?? 0);
if($name === '' || $lat==0 || $lng==0){
  echo json_encode(['success'=>false, 'error'=>'Dados incompletos']);
  exit;
}
$file = __DIR__ . '/markers.json';
$markers = [];
if(file_exists($file)){
  $c = file_get_contents($file);
  $markers = json_decode($c, true);
  if(!is_array($markers)) $markers = [];
}
// acrescentar novo marcador
$markers[] = [
  'name' => $name,
  'desc' => $desc,
  'lat' => $lat,
  'lng' => $lng,
  'created_at' => date('c')
];
// escrever de volta (bloqueio simples)
$fp = fopen($file, 'c+');
if($fp === false){
  echo json_encode(['success'=>false,'error'=>'Não foi possível abrir ficheiro']);
  exit;
}

flock($fp, LOCK_EX);
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($markers, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
flock($fp, LOCK_UN);
fclose($fp);

echo json_encode(['success'=>true]);