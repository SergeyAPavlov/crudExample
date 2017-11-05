<?php
try {
    require_once("../vendor/autoload.php");
    $app = new crudExample\App();
    $app->init();
    $main = new crudExample\controllers\main($app);
    $main->requestAll();
} catch (\Throwable $t) {
    if ($app) $app->logIt($t, 'top_errors', 2);
    else echo $t->getMessage();
}
if ($app) {
    if ($app->debug) {
        $log = $app->log;
        foreach ($log as $record) {
            if ($record[2] >= $app->debug) {
                var_dump($record);
            }
        }
    }
}
