<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class ShiftRecordMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "shift_record" table exists after running the migration.
     *
     * @return void
     */
    public function testShiftRecordTableExists()
    {
        $this->assertTrue(Schema::hasTable('shift_record'));
    }

    /**
     * Test if the "shifts" column exists and is of type "text".
     *
     * @return void
     */
    public function testShiftRecordTableShiftsColumn()
    {
        $columnInfo = Schema::getColumnType('shift_record', 'shifts');
        $this->assertEquals('text', $columnInfo);
    }

    /**
     * Test if the "shifts" column allows null values.
     *
     * @return void
     */
    public function testShiftRecordTableShiftsColumnAllowsNull()
    {
        $columnInfo = Schema::getConnection()->getDoctrineColumn('shift_record', 'shifts');
        $this->assertTrue(!$columnInfo->getNotnull());
    }
}
