<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CompanyShiftOffDaysModel;

class CompanyShiftOffDaysModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "company_shift_off_days" table is associated with the model.
     *
     * @return void
     */
    public function testCompanyShiftOffDaysModelTable()
    {
        $companyShiftOffDays = new CompanyShiftOffDaysModel();
        $this->assertEquals('company_shift_off_days', $companyShiftOffDays->getTable());
    }

    /**
     * Test if the "date" attribute is fillable in the model.
     *
     * @return void
     */
    public function testCompanyShiftOffDaysModelFillable()
    {
        $companyShiftOffDays = new CompanyShiftOffDaysModel();
        $fillable = ['date'];

        $this->assertEqualsCanonicalizing($fillable, $companyShiftOffDays->getFillable());
    }
}
