<?php
namespace Tests\Unit\Requests;
use Tests\TestCase;
use App\Http\Requests\EmloyeeRequest;

class EmployeeRequestTest extends TestCase {

    public function testRequestRulePass(){
        $companyShiftOffDaysRequest = new EmloyeeRequest();
        $this->assertEquals([
            'name' => 'required|string',
            'preferred_shift' => 'required|in:day,night,evening',
        ], $companyShiftOffDaysRequest->rules());
    }
}