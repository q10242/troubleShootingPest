<?php
namespace Tests\Unit\Requests;
use Tests\TestCase;
use App\Http\Requests\EmloyeeShiftOffRequest;

class EmployeeShiftOffRequestTest extends TestCase {

    public function testRequestRulePass(){
        $companyShiftOffDaysRequest = new EmloyeeShiftOffRequest();
        $this->assertEquals([
            'employee_id' => 'required|exists:App\Models\EmployeersModel,id',
            'date' => 'required|date',
        ], $companyShiftOffDaysRequest->rules());
    }

}