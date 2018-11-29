<?php

require_once 'bootstrap.php';

/**
 * Validation is not tested here since I have not changed it so it is not part of my API.
 * Instead I will only test certain validators within the MongoDocumentTest.php file and
 * consider validation working.
 */
class MongoModelTest extends CTestCase
{
	public function testModelCreation()
	{
		$d = new Dummy();
		$this->assertInstanceOf('pcmnac\mongoyii\Model', $d);
	}

	public function testMagics()
	{
		$d = new Dummy();
		$d->username = 'pcmnac';
		$this->assertEquals('pcmnac', $d->username);
		$this->assertTrue(isset($d->username));
		unset($d->username);
		$this->assertFalse(isset($d->username));
	}

	public function testAttributes()
	{
		$d = new Dummy();
		$d->dum = 'dum-dum';
		$this->assertTrue($d->hasAttribute('dum'));

		$an = $d->attributeNames();
		$this->assertArrayHasKey('dum',array_flip($an));

		$d->username = 'pcmnac';
		$attr = $d->getAttributes();
		$this->assertArrayHasKey('username', $attr);
		$this->assertArrayHasKey('dum', $attr);
	}

	/**
	 * @covers pcmnac\mongoyii\Model::getDbConnection
	 */
	public function testGetDbConnection()
	{
		$d = new Dummy();
		$dbc = $d->getDbConnection();
		$this->assertInstanceOf('pcmnac\mongoyii\Client', $dbc);
	}

	/**
	 * @covers pcmnac\mongoyii\Model::getDocument
	 */
	public function testGetDocument()
	{
		$d = new Dummy();
		$d->dum = 'dum-dum';
		$d->username = 'pcmnac';

		$doc = $d->getDocument();
		$this->assertArrayHasKey('username', $doc);
		$this->assertArrayHasKey('dum', $doc);
	}

	/**
	 * @covers pcmnac\mongoyii\Model::getRawDocument
	 */
	public function testGetRawDocument()
	{
		$d = new Dummy();
		$d->dum = 'dum-dum';
		$d->username = 'pcmnac';

		$doc = $d->getRawDocument();
		$this->assertArrayHasKey('username', $doc);
		$this->assertArrayHasKey('dum', $doc);
	}

	/**
	 * @covers pcmnac\mongoyii\Model::getJSONDocument
	 */
	public function testGetJSONDocument()
	{
		$d = new Dummy();
		$d->dum = 'dum-dum';
		$d->username = 'pcmnac';

		$doc = $d->getJSONDocument();
		$this->assertTrue(array_key_exists('username', json_decode($doc)));
		$this->assertTrue(array_key_exists('dum', json_decode($doc)));
	}

	/**
	 * @covers pcmnac\mongoyii\Model::getBSONDocument
	 */
	public function testGetBSONDocument()
	{
		$d = new Dummy();
		$d->dum = 'dum-dum';
		$d->username = 'pcmnac';

		$doc = $d->getBSONDocument();
		$this->assertTrue(array_key_exists('username', bson_decode($doc)));
		$this->assertTrue(array_key_exists('dum', bson_decode($doc)));
	}
}