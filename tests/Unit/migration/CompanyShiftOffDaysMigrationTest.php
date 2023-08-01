<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CompanyShiftOffDaysMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "company_shift_off_days" table exists after running the migration.
     *
     * @return void
     */
    public function testCompanyShiftOffDaysTableExists()
    {
        $this->assertTrue(Schema::hasTable('company_shift_off_days'));
    }

    /**
     * Test if the "date" column exists and is of type "date".
     *
     * @return void
     */
    public function testCompanyShiftOffDaysTableDateColumn()
    {
        $columnInfo = Schema::getColumnType('company_shift_off_days', 'date');
        $this->assertEquals('date', $columnInfo);
    }

    /**
     * Test if the "date" column allows null values.
     *
     * @return void
     */
    public function testCompanyShiftOffDaysTableDateColumnAllowsNull()
    {
        $columnInfo = Schema::getConnection()->getDoctrineColumn('company_shift_off_days', 'date');
        $this->assertTrue(!$columnInfo->getNotnull());
    }
}
