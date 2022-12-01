<?php

require_once(__DIR__.'/../../config/config.php');
require_once(__DIR__.'/../../models/Event.php');

// Variables

$created = $_SESSION['id'];

$events = Event::get($created);

echo json_encode($events);

