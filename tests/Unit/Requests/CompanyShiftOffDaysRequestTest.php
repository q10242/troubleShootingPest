<?php
namespace Tests\Unit\Requests;
use Tests\TestCase;
use App\Http\Requests\CompanyShiftOffDaysRequest;

class CompanyShiftOffDaysRequestTest extends TestCase {

    public function testRequestRulePass(){
        $companyShiftOffDaysRequest = new CompanyShiftOffDaysRequest();
        $this->assertEquals([
            'date' => 'required|date'
        ], $companyShiftOffDaysRequest->rules());
    }


    /**
     * Test validation rules for creating company shift off day.
     *
     * @return void
     */
    public function testValidationRules()
    {
        $requestData = [];
        // 嘗試發出 POST 請求並使用空的資料陣列
        $response = $this->postJson('/api/company-shift-off-days', $requestData);
        // 驗證是否返回 422 Unprocessable Entity 狀態碼，代表驗證失敗
        $response->assertStatus(422);

        // 驗證是否返回驗證錯誤訊息，此處應該會包含 'date' 欄位的錯誤
        $response->assertJsonValidationErrors('date');

        // 用一個有效的日期資料重新發出請求
        $requestData = ['date' => '2023-07-27'];
        $response = $this->postJson('/api/company-shift-off-days', $requestData, ['Content-Type' => 'application/json']);

        // 驗證是否成功（HTTP 201 Created）
        $response->assertStatus(201);
    }

}