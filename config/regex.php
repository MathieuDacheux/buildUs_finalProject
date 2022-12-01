<?php

define('REGEX_MAIL', '^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$');
define('REGEX_NAME', '^(?=.{1,50}$)[a-zA-Z]+(?:[\'_.\s][a-z]+)*$');
define('REGEX_PASSWORD', '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$');
define('REGEX_PHONE', '^[0-9]{10}$');
define('REGEX_SIRET', '^[0-9]{14}$');
define('REGEX_INCOME', '^[0-9]{1,6}([.,][0-9]{1,2})?$');
define('REGEX_PAGE', '^[0-9]{1,3}$');
define('REGEX_ID', '^[0-9]{1,5}$');
define('REGEX_DATE', '^[0-9]{4}-[0-9]{2}-[0-9]{2}$');