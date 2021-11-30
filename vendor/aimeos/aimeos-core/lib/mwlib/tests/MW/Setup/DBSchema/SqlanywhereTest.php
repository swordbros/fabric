<?php

namespace Aimeos\MW\Setup\DBSchema;


class SqlanywhereTest extends \PHPUnit\Framework\TestCase
{
	private $mock;
	private $object;
	private $dbmStub;


	protected function setUp() : void
	{
		$this->mock = $this->getMockBuilder( \Aimeos\MW\DB\Connection\PDO::class )
			->setMethods( array( 'create' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub = $this->getMockBuilder( \Aimeos\MW\DB\Manager\PDO::class )
			->setMethods( array( 'acquire', 'release' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->object = new \Aimeos\MW\Setup\DBSchema\Sqlanywhere( $this->dbmStub, 'db', 'dbname', 'sqlanywhere' );
	}


	protected function tearDown() : void
	{
		unset( $this->object );
	}


	public function testTableExists()
	{
		$stmt = $this->getMockBuilder( \Aimeos\MW\DB\Statement\PDO\Simple::class )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( \Aimeos\MW\DB\Result\PDO::class )
			->setMethods( array( 'fetch', '__destruct' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( null ) );

		$this->assertFalse( $this->object->tableExists( 'testtable' ) );
	}


	public function testSequenceExists()
	{
		unset( $this->dbmStub );
		$this->assertFalse( $this->object->sequenceExists( 'testseqence' ) );
	}


	public function testIndexExists()
	{
		$stmt = $this->getMockBuilder( \Aimeos\MW\DB\Statement\PDO\Simple::class )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( \Aimeos\MW\DB\Result\PDO::class )
			->setMethods( array( 'fetch', '__destruct' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( null ) );

		$this->assertFalse( $this->object->indexExists( 'testtable', 'testindex' ) );
	}


	public function testConstraintExists()
	{
		$stmt = $this->getMockBuilder( \Aimeos\MW\DB\Statement\PDO\Simple::class )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( \Aimeos\MW\DB\Result\PDO::class )
			->setMethods( array( 'fetch', '__destruct' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( null ) );

		$this->assertFalse( $this->object->constraintExists( 'testtable', 'testconstraint' ) );
	}


	public function testColumnExists()
	{
		$stmt = $this->getMockBuilder( \Aimeos\MW\DB\Statement\PDO\Simple::class )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( \Aimeos\MW\DB\Result\PDO::class )
			->setMethods( array( 'fetch', '__destruct' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( null ) );

		$this->assertFalse( $this->object->columnExists( 'testtable', 'testcolumn' ) );
	}


	public function testGetColumnDetails()
	{
		$data = array(
			'table_name' => 'testtable',
			'column_name' => 'testcolumn',
			'base_type_str' => 'varchar',
			'width' => 16,
			'default' => 'default',
			'nulls' => 'f',
		);

		$stmt = $this->getMockBuilder( \Aimeos\MW\DB\Statement\PDO\Simple::class )
			->setMethods( array( 'bind', 'execute' ) )
			->disableOriginalConstructor()
			->getMock();

		$result = $this->getMockBuilder( \Aimeos\MW\DB\Result\PDO::class )
			->setMethods( array( 'fetch', '__destruct' ) )
			->disableOriginalConstructor()
			->getMock();

		$this->dbmStub->expects( $this->once() )->method( 'acquire' )->will( $this->returnValue( $this->mock ) );
		$this->dbmStub->expects( $this->once() )->method( 'release' )->with( $this->equalTo( $this->mock ) );

		$this->mock->expects( $this->once() )->method( 'create' )->will( $this->returnValue( $stmt ) );
		$stmt->expects( $this->once() )->method( 'execute' )->will( $this->returnValue( $result ) );
		$result->expects( $this->once() )->method( 'fetch' )->will( $this->returnValue( $data ) );

		$columnItem = $this->object->getColumnDetails( 'testtable', 'testcolumn' );

		$this->assertEquals( 'testtable', $columnItem->getTableName() );
		$this->assertEquals( 'testcolumn', $columnItem->getName() );
		$this->assertEquals( 'varchar', $columnItem->getDataType() );
		$this->assertEquals( 16, $columnItem->getMaxLength() );
		$this->assertEquals( 'default', $columnItem->getDefaultValue() );
		$this->assertFalse( $columnItem->isNullable() );
	}
}
