<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmployeersModel;
use App\Models\EmployeeShiftOffModel;

class EmployeeShiftOffModelTest extends TestCase {
    use RefreshDatabase;
    
    
    /**
     * Test if the "company_shift_off_days" table is associated with the model.
     *
     * @return void
     */
    public function testEmployeeShiftOffModelTable()
    {
        $employeeShiftOff = new EmployeeShiftOffModel();
        $this->assertEquals('employee_shift_off_days', $employeeShiftOff->getTable());
    }

    /**
     * Test if the "date" attribute is fillable in the model.
     *
     * @return void
     */
    public function testEmployeeShiftOffModelFillable()
    {
        $employeeShiftOff = new EmployeeShiftOffModel();
        $fillable = ['date', 'employee_id'];

        $this->assertEqualsCanonicalizing($fillable, $employeeShiftOff->getFillable());
    }
}