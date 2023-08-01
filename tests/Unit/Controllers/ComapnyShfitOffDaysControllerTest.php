<?php
namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CompanyShiftOffDaysModel;
use App\Http\Requests\CompanyShiftOffDaysRequest;
use App\Http\Controllers\CompanyShiftOffDaysController;
class ComapnyShfitOffDaysControllerTest extends TestCase
{

    use RefreshDatabase;
    public function testCreateCompanyShiftOffDays()
    {
        $testDate = '2021-01-01';
        $requestData = ['date' => $testDate];
        $response = $this->postJson('/api/company-shift-off-days', $requestData);
        // 驗證是否返回 HTTP 201 Created 狀態碼
        $response->assertStatus(201);

        // 驗證資料庫中是否存在指定日期的資料
        $this->assertDatabaseHas('company_shift_off_days', ['date' => $testDate]);
    }

    public function testCreateCompanyShiftOffDaysFail() 
    {
        $requestData= [];
        $response = $this->postJson('/api/company-shift-off-days', $requestData);
        // 驗證是否返回 HTTP 422 Unprocessable Entity 狀態碼
        $response->assertStatus(422);
        $this->assertDatabaseEmpty('company_shift_off_days');
    }

        /**
     * Test delete company shift off days.
     *
     * @return void
     */
    public function testDeleteCompanyShiftOffDays()
    {
        // 先創建一個 CompanyShiftOffDaysModel 實例
        $companyShiftOffDays = CompanyShiftOffDaysModel::create(['date' => '2023-07-27']);
       
        // 發送 DELETE 請求，並帶上對應的 ID
        $response = $this->deleteJson('/api/company-shift-off-days/'.$companyShiftOffDays->id);

        // 驗證是否成功刪除（HTTP 204 No Content）
        $response->assertStatus(204);

        // 驗證資料庫中的資料是否已經被刪除
        $this->assertDatabaseMissing('company_shift_off_days', ['id' => $companyShiftOffDays->id]);
    }

    /**
     * Test delete company shift off days with invalid ID.
     *
     * @return void
     */
    public function testDeleteCompanyShiftOffDaysWithInvalidId()
    {
        // 發送 DELETE 請求，並帶上無效 ID
        $response = $this->delete('/api/company-shift-off-days/999');
        // 驗證是否拒絕刪除（HTTP 404 Not Found）
        $response->assertStatus(404);
        // 驗證資料庫中的資料是否仍然存在
        $this->assertFalse(CompanyShiftOffDaysModel::where('id', 999)->exists());
    }

    public function testDeleteCompanyShiftOffDaysWithValidId()
    {
        // 先創建一個 CompanyShiftOffDaysModel 實例
        $companyShiftOffDays = CompanyShiftOffDaysModel::create(['date' => '2023-07-27']);
        // 發送 DELETE 請求，並帶上有效 ID
        $response = $this->delete("/api/company-shift-off-days/{$companyShiftOffDays->id}");
        // 驗證是否成功刪除（HTTP 204 No Content）
        $response->assertStatus(204);
        // 驗證資料庫中的資料是否已被刪除
        $this->assertDatabaseMissing('company_shift_off_days', ['id' => $companyShiftOffDays->id]);
    }

    public function testCompanyShiftOffDaysIndex() {
        // 先創建一個 CompanyShiftOffDaysModel 實例
        $companyShiftOffDays = CompanyShiftOffDaysModel::create(['date' => '2023-07-27']);
        // 發送 GET 請求
        $response = $this->get('/api/company-shift-off-days');
        // 驗證是否成功取得資料（HTTP 200 OK）
        $response->assertStatus(200);
        // 驗證回傳的 JSON 資料是否符合預期
        $response->assertJson([$companyShiftOffDays->toArray()]);
    }
    

}