<?php

require_once 'bootstrap.php';

class MongoClientTest extends CTestCase
{
	/**
	 * @covers pcmnac\mongoyii\Client
	 */
	public function testSettingUpConnection()
	{
		$mongo = Yii::app()->mongodb;
		$this->assertInstanceOf('pcmnac\mongoyii\Client', $mongo);
	}

	/**
	 * @covers pcmnac\mongoyii\Client::selectCollection
	 */
	public function testSelectCollection()
	{
		$mongo = Yii::app()->mongodb;

		$this->assertInstanceOf('pcmnac\mongoyii\Collection', $mongo->selectCollection('t'));
	}

	/**
	 * @covers pcmnac\mongoyii\Client::selectDatabase
	 */
	public function testGetDB()
	{
		$mongo = Yii::app()->mongodb;
		$this->assertInstanceOf('pcmnac\mongoyii\Database', $mongo->selectDatabase());
	}

	/**
	 * @covers EMongoClient::getDefaultWriteConcern
	 */
	public function testWriteConcern()
	{
		// No longer done by the extension directly
	}

	/**
	 * @covers pcmnac\mongoyii\Client::createMongoIdFromTimestamp
	 */
	public function testCreateMongoIDFromTimestamp()
	{
		$mongo = Yii::app()->mongodb;
		$id = $mongo->createMongoIdFromTimestamp(time());
		$this->assertTrue($id instanceof MongoId);
	}
}