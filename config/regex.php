<?php

define('REGEX_MAIL', '^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$');
define('REGEX_NAME', '^(?=.{1,50}$)[a-zA-Z]+(?:[\'_.\s][a-z]+)*$');
define('REGEX_PASSWORD', '^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})');
define('REGEX_CGU', '^(1|2)$');