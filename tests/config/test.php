<?php

use MongoDB\Driver\WriteConcern;
use MongoDB\Driver\ReadPreference;

return CMap::mergeArray(
	require ('../../../config/main.php'), 
	array(
		'components' => array (
			'mongodb' => array(
				'class' => 'pcmnac\mongoyii\Client',
				'uri' => 'mongodb://localhost:27017/admin',
				'options' => [],
				'driverOptions' => [],
				'db' => [
					'super_test' => [
						'writeConcern' => new WriteConcern(1),
						'readPreference' => new ReadPreference(ReadPreference::RP_PRIMARY),
					]
				],
				'enableProfiling' => true
			),
			'authManager' => array (
				'class' => 'pcmnac\mongoyii\AuthManager' 
			) 
		) 
	)
);
