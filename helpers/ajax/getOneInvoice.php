<?php

require_once(__DIR__.'/../../config/config.php');
require_once(__DIR__.'/../../models/Invoice.php');

// Variables

$created = $_SESSION['id'];
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

$invoice = Invoice::getOne($created, $id);

echo json_encode($lastIncome);

