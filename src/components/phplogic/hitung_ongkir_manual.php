<?php
$jarak = (int) $_POST['jarak'];
$kurir = strtolower($_POST['kurir']);
$berat = (int) $_POST['berat'];

$kurir_adjustment = [
  'jne' => 0,
  'jnt' => 1000,
  'tiki' => 2000,
  'sicepat' => 1000
];

if ($jarak <= 20) {
  $ongkir_dasar = 2000;
} elseif ($jarak <= 40) {
  $ongkir_dasar = 10000;
} else {
  $ongkir_dasar = 25000;
}

$kg = ceil($berat / 1000);

$ongkir = $ongkir_dasar * $kg;
$ongkir += $kurir_adjustment[$kurir] ?? 0;

echo json_encode(['ongkir' => $ongkir]);
