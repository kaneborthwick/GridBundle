<?php

use GridBundle\Handler\TestHandler;

return [
	'routes' => [
		[
			'name' => 'grid.test',
			'path' => '/grid/test',
			'allowed_methods' => ['GET'],
			'middleware' => [
				TestHandler::class,
			],
			'options' => [
				'same' => 'same',
			],
		],
	],
];