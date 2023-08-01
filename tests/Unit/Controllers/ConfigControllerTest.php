<?php
namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ConfigModel;

class ConfigControllerTest extends TestCase
{

    use RefreshDatabase;
    public function testCreateConfig()
    {
        $requestData = ['key' => 'max_employee_shift_off_day_number', 'value' => 3];
        $response = $this->postJson('/api/config', $requestData);
        // 驗證是否返回 HTTP 201 Created 狀態碼
        $response->assertStatus(201);

        // 驗證資料庫中是否存在指定日期的資料
        $this->assertDatabaseHas('config', ['key' => 'max_employee_shift_off_day_number', 'value' => 3]);
    }

    public function testCreateConfigFail() 
    {
        $requestData= [];
        $response = $this->postJson('/api/config', $requestData);
        // 驗證是否返回 HTTP 422 Unprocessable Entity 狀態碼
        $response->assertStatus(422);
        $this->assertDatabaseEmpty('config');
    }

        /**
     * Test delete company shift off days.
     *
     * @return void
     */
    public function testDeleteConfig()
    {
        // 先創建一個 ConfigModel 實例
        $Config = ConfigModel::create(['key' => 'max_employee_shift_off_day_number', 'value' => 3]);
       
        // 發送 DELETE 請求，並帶上對應的 ID
        $response = $this->deleteJson('/api/config/'.$Config->id);

        // 驗證是否成功刪除（HTTP 204 No Content）
        $response->assertStatus(204);

        // 驗證資料庫中的資料是否已經被刪除
        $this->assertDatabaseMissing('config', ['id' => $Config->id]);
    }

    /**
     * Test delete company shift off days with invalid ID.
     *
     * @return void
     */
    public function testDeleteConfigWithInvalidId()
    {
        // 發送 DELETE 請求，並帶上無效 ID
        $response = $this->delete('/api/config/999');
        // 驗證是否拒絕刪除（HTTP 404 Not Found）
        $response->assertStatus(404);
        // 驗證資料庫中的資料是否仍然存在
        $this->assertFalse(ConfigModel::where('id', 999)->exists());
    }

    public function testDeleteConfigWithValidId()
    {
        // 先創建一個 ConfigModel 實例
        $Config = ConfigModel::create(['key' => 'max_employee_shift_off_day_number', 'value' => 3]);
        // 發送 DELETE 請求，並帶上有效 ID
        $response = $this->delete("/api/config/{$Config->id}");
        // 驗證是否成功刪除（HTTP 204 No Content）
        $response->assertStatus(204);
        // 驗證資料庫中的資料是否已被刪除
        $this->assertDatabaseMissing('config', ['id' => $Config->id]);
    }

    public function testConfigIndex() {
        // 先創建一個 ConfigModel 實例
        $Config = ConfigModel::create(['key' => 'max_employee_shift_off_day_number', 'value' => 3]);
        // 發送 GET 請求
        $response = $this->get('/api/config');
        // 驗證是否成功取得資料（HTTP 200 OK）
        $response->assertStatus(200);
        // 驗證回傳的 JSON 資料是否符合預期
        $response->assertJson([$Config->toArray()]);
    }
    

}