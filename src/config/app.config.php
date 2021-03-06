<?php

use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator([
	new PhpFileProvider(__DIR__ . '/app/{,*.}config.php'),
]);

return $aggregator->getMergedConfig();
