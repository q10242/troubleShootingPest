<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeeShiftOffDaysMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "employee_shift_off_days" table exists after running the migration.
     *
     * @return void
     */
    public function testEmployeeShiftOffDaysTableExists()
    {
        $this->assertTrue(Schema::hasTable('employee_shift_off_days'));
    }

    /**
     * Test if the "employee_id" column is a foreign key constrained to "employees" table.
     *
     * @return void
     */
    public function testEmployeeShiftOffDaysTableEmployeeIdColumn()
    {
        $columnInfo = Schema::getConnection()->getDoctrineColumn('employee_shift_off_days', 'employee_id');
        $this->assertEquals('bigint', $columnInfo->getType()->getName());
        $this->assertTrue($columnInfo->getNotnull());

        $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('employee_shift_off_days');

        $this->assertCount(1, $foreignKeys);
        $this->assertEquals('employeers', $foreignKeys[0]->getForeignTableName());
    }

    /**
     * Test if the "date" column exists and is of type "date".
     *
     * @return void
     */
    public function testEmployeeShiftOffDaysTableDateColumn()
    {
        $columnInfo = Schema::getColumnType('employee_shift_off_days', 'date');
        $this->assertEquals('date', $columnInfo);
    }

    /**
     * Test if the "date" column allows null values.
     *
     * @return void
     */
    public function testEmployeeShiftOffDaysTableDateColumnAllowsNull()
    {
        $columnInfo = Schema::getConnection()->getDoctrineColumn('employee_shift_off_days', 'date');
        $this->assertTrue($columnInfo->getNotnull());
    }
}
