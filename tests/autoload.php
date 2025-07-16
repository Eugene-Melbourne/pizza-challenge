<?php

require_once __DIR__.'/../vendor/autoload.php';

$env = env('APP_ENV', 'not set');
$db = env('DB_DATABASE', 'not set');

echo '(ツ)'."\n";
echo '┌-------------------------------------------------------------┐'."\n";
echo '| Env                    :'.$env."\n";
echo '| Current UTC time       :'.now()."\n";
echo '| Current Melbourne time :'.now()->timezone('Australia/Melbourne')."\n";
echo '| Database               :'.$db."\n";
echo '└-------------------------------------------------------------┘'."\n";

echo shell_exec('php artisan migrate:fresh --seed');
