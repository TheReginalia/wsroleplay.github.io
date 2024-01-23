<?php
require_once(__DIR__ . "/../../config.php");

$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

$discordid = htmlspecialchars($_GET['discordid']);

$arrests = $pdo->query("SELECT * FROM arrests WHERE unitdiscordid='$discordid'");
$citations = $pdo->query("SELECT * FROM citations WHERE unitdiscordid='$discordid'");
$warnings = $pdo->query("SELECT * FROM warnings WHERE unitdiscordid='$discordid'");
$warrants = $pdo->query("SELECT * FROM warrants WHERE unitdiscordid='$discordid'");

$data = [
    'arrests' => sizeof($arrests->fetchAll()),
    'citations' => sizeof($citations->fetchAll()),
    'warnings' => sizeof($warnings->fetchAll()),
    'warrants' => sizeof($warrants->fetchAll())
];

header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
