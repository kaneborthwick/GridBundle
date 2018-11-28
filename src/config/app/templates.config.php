<?php

use GridBundle\Twig\GridExtension;

return [
	'templates' => [
		'extensions' => [
			GridExtension::class,
		],
		'paths' => [
			'grid' => [__DIR__ . '/../../../templates/grid'],
		],
	],
];
