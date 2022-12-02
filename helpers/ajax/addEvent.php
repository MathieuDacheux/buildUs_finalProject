<?php

require_once(__DIR__.'/../../config/config.php');
require_once(__DIR__.'/../../models/Event.php');

// Variables

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titleEvent = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    // Date de début
    $start_at = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_SPECIAL_CHARS);
    // Suppression la partie entre les parenthèses
    $start_at = preg_replace('/\([^)]+\)/', '', $start_at);
    // Changement du format de date
    $start_at = new DateTime($start_at, new DateTimeZone('Europe/Paris'));
    $start_at = $start_at->format('Y-m-d H:i:s');
    // Date de fin
    $end_at = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_SPECIAL_CHARS);
    // Suppression la partie entre les parenthèses
    $end_at = preg_replace('/\([^)]+\)/', '', $end_at);
    // Changement du format de date
    $end_at = new DateTime($end_at, new DateTimeZone('Europe/Paris'));
    $end_at = $end_at->format('Y-m-d H:i:s');

    $created = $_SESSION['id'];

}