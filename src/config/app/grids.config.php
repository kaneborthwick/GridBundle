<?php

return [
	'tower_grids' => [

		'grids' => [],

		'grid_fields' => [
			[
				'class' => Towersystems\Grid\FieldTypes\StringFieldType::class,
				'type' => 'string',
			],
			[
				'class' => Towersystems\Grid\FieldTypes\DatetimeFieldType::class,
				'type' => 'datetime',
			],
		],

		'grid_filters' => [
			[
				'class' => Towersystems\Grid\Filter\DateFilter::class,
				'type' => 'date',
				'form_type' => 'same', // ? ?
			],
		],

		'templates' => [

			'filter' => [
				'date' => "ui:",
			],

		],

	],
];