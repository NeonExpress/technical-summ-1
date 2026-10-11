<?php

echo (extension_loaded('sqlite3') ? 'sqlite3=yes' : 'sqlite3=no') . PHP_EOL;
echo PHP_BINARY . PHP_EOL;
echo php_ini_loaded_file() . PHP_EOL;
echo PHP_VERSION . PHP_EOL;
echo php_sapi_name() . PHP_EOL;
echo get_cfg_var('extension') . PHP_EOL;
