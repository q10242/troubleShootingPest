<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeersMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "employeers" table exists after running the migration.
     *
     * @return void
     */
    public function testEmployeersTableExists()
    {
        $this->assertTrue(Schema::hasTable('employeers'));
    }

    /**
     * Test if the "name" column exists and is of type "string".
     *
     * @return void
     */
    public function testEmployeersTableNameColumn()
    {
        $columnInfo = Schema::getColumnType('employeers', 'name');
        $this->assertEquals('string', $columnInfo);
    }

    /**
     * Test if the "preferred_shift" column exists and is of type "string".
     *
     * @return void
     */
    public function testEmployeersTablePreferredShiftColumn()
    {
        $columnInfo = Schema::getColumnType('employeers', 'preferred_shift');
        $this->assertEquals('string', $columnInfo);
    }

    /**
     * Test if the "preferred_shift" column allows null values.
     *
     * @return void
     */
    public function testEmployeersTablePreferredShiftColumnAllowsNull()
    {
        $columnInfo = Schema::getConnection()->getDoctrineColumn('employeers', 'preferred_shift');
        $this->assertTrue($columnInfo->getNotnull());
    }
}
