<?php

/*
 *  All rights reserved © 2020 Eptech.
 */

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$configAggregator = new ConfigAggregator([
    new PhpFileProvider(__DIR__.'/autoload/local.php'),
    Erik\ErikTMDBClient\ConfigProvider::class,
    Erik\ErikTMDBCron\ConfigProvider::class,
]);

return $configAggregator->getMergedConfig();
