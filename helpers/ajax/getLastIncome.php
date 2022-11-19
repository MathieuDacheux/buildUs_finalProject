<?php

require_once(__DIR__.'/../../config/config.php');
require_once(__DIR__.'/../../models/Income.php');

// Variables

$created = $_SESSION['id'];

$lastIncome = Income::getLastIncome($created);

echo json_encode($lastIncome);

