<?php

require_once(__DIR__.'/../../config/config.php');
require_once(__DIR__.'/../../models/Income.php');
require_once(__DIR__.'/../../models/Admin.php');

// Variables

$created = $_SESSION['id'];

$lastIncome = Income::getSevenDays($created);

echo json_encode($lastIncome);
