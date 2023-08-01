<?php
namespace Tests\Unit\Requests;
use Tests\TestCase;
use App\Http\Requests\ConfigRequest;
class  ConfigRequestTest extends TestCase
{
    public function testRequestRulePass(){
        $companyShiftOffDaysRequest = new ConfigRequest();
        $this->assertEquals([
            'key' => 'required|string',
            'value' => 'required',
        ], $companyShiftOffDaysRequest->rules());
    }
}