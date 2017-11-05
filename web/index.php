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
    if ($app->debug AND !empty($app->log)) {
        $dump = '';
        $log = $app->log;
        foreach ($log as $record) {
            if ($record[2] >= $app->debug) {
                echo "* * *<br>\n";
                var_dump($record);
            }
            ob_start();
            var_dump($record);
            $dump .= "\n" . ob_get_contents();
            ob_end_clean();
            file_put_contents('../log/log' . time(), $dump);
        }

    }

}
