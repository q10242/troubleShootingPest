<?php
namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\EmployeersModel;
use App\Models\EmployeeShiftOffModel;
class EmployeeShiftOffControllerTest extends TestCase
{

    use RefreshDatabase;

    private $employ_id;
    protected function setUp(): void
    {
        parent::setUp();
        $employee = EmployeersModel::create(['name' => 'John Wick', 'preferred_shift' => 'day']);
        $this->employ_id = $employee->id;
    }


    public function testCreateEmployShiftOff()
    {
        $requestData = ['date' => '2022-03-07', 'employee_id' => $this->employ_id];
        $response = $this->postJson('/api/employee_shift_off', $requestData);
        // 驗證是否返回 HTTP 201 Created 狀態碼
        $response->assertStatus(201);

        // 驗證資料庫中是否存在指定日期的資料
        $this->assertDatabaseHas('employee_shift_off_days', ['date' => '2022-03-07', 'employee_id' => $this->employ_id]);
    }
    
    public function testCreateEmployShiftOffFail() 
    {
        $requestData= [];
        $response = $this->postJson('/api/employee_shift_off', $requestData);
        // 驗證是否返回 HTTP 422 Unprocessable Entity 狀態碼
        $response->assertStatus(422);
        $this->assertDatabaseEmpty('employee_shift_off_days');
       
        $requestData= ['date' => '2022-03-07', 'employee_id' => $this->employ_id +1];
        $response = $this->postJson('/api/employee_shift_off', $requestData);
        // 驗證是否返回 HTTP 422 Unprocessable Entity 狀態碼
        $response->assertStatus(422);
        $this->assertDatabaseEmpty('employee_shift_off_days');
    }


    public function testIndexEmployShiftOff()
    {
        $requestData = ['date' => '2022-03-07', 'employee_id' => $this->employ_id];
        $this->postJson('/api/employee_shift_off', $requestData);
        $response = $this->getJson('/api/employee_shift_off');
        $response->assertStatus(200);
        $this->assertEquals($response[0]['date'], '2022-03-07');
    }
    

    public function testUpdateEmployShiftOff(){
        $employee = EmployeersModel::create(['name' => 'John Wick', 'preferred_shift' => 'day']);
        $testData = ['date' => '2022-03-07', 'employee_id' => $this->employ_id];
        $employeeShiftOff = EmployeeShiftOffModel::create($testData);
        // 目前進度到這裡
        $requestData = ['date' => '2022-04-07', 'employee_id' => $this->employ_id];

        $response = $this->putJson('/api/employee_shift_off/'.$employeeShiftOff->id,$requestData);
        $response->assertStatus(200);
        $this->assertEquals($response['date'], '2022-04-07');
    }

}