<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ConfigMigrationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test the "config" table exists after running the migration.
     *
     * @return void
     */
    public function testConfigTableExists()
    {
        $this->assertTrue(Schema::hasTable('config'));
    }

    /**
     * Test the columns of the "config" table after running the migration.
     *
     * @return void
     */
    public function testConfigTableColumns()
    {
        $expectedColumns = ['id', 'key', 'value', 'created_at', 'updated_at'];
        $actualColumns = Schema::getColumnListing('config');

        $this->assertEqualsCanonicalizing($expectedColumns, $actualColumns);
    }

    /**
     * Test the "key" column is unique.
     *
     * @return void
     */
    public function testConfigTableKeyColumnIsUnique()
    {
        $indexes = Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('config');
        $isUnique = $indexes['config_key_unique']->isUnique();

        $this->assertTrue($isUnique);
    }

    /**
     * Test if the "value" column allows null values.
     *
     * @return void
     */
    public function testConfigTableValueColumnAllowsNull()
    {
      
    
        $this->assertTrue(Schema::getColumnType('config', 'value') === 'text');
        $columnInfo = Schema::getConnection()->getDoctrineColumn('config', 'value');
        $isNullable = $columnInfo->getNotnull();
        $this->assertFalse($isNullable);
    }
}