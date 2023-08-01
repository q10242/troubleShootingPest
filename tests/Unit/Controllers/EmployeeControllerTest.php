<?php
namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmployeersModel;
class EmployeeControllerTest extends TestCase
{

    use RefreshDatabase;
    public function testCreateEmployee()
    {

        $requestData = ['name' => 'John Wick', 'preferred_shift' => 'day'];
        $response = $this->postJson('/api/employee', $requestData);
        // 驗證是否返回 HTTP 201 Created 狀態碼
        $response->assertStatus(201);

        // 驗證資料庫中是否存在指定日期的資料
        $this->assertDatabaseHas('employeers', $requestData);
    }
    public function testCreateEmployeeFail() 
    {
        $requestData= [];
        $response = $this->postJson('/api/employee', $requestData);
        // 驗證是否返回 HTTP 422 Unprocessable Entity 狀態碼
        $response->assertStatus(422);
        $this->assertDatabaseEmpty('employeers');
    }

    public function testEmployeeIndex()
    {
        $requestData = ['name' => 'John Wick', 'preferred_shift' => 'day'];
        $this->postJson('/api/employee', $requestData);
        $response = $this->getJson('/api/employee');
        $response->assertStatus(200);
        $this->assertEquals($response[0]['name'], 'John Wick');
    }

    public function testEmployeeUpdate(){
        $testData = ['name' => 'John Wick', 'preferred_shift' => 'day'];
        $testData = EmployeersModel::create($testData);

        $response = $this->putJson('/api/employee/'.$testData->id, ['name' => 'John Wick', 'preferred_shift' => 'night']);
        $response->assertStatus(200);
        $this->assertEquals($response['preferred_shift'], 'night');
    }
    public function testEmployeeUpdateFail(){
        $testData = ['name' => 'John Wick', 'preferred_shift' => 'day'];
        $testData = EmployeersModel::create($testData);

        $response = $this->putJson('/api/employee/999', ['name' => 'John Wick', 'preferred_shift' => 'night']);
        $response->assertStatus(404);

        $response = $this->putJson('/api/employee/'.$testData->id, ['name' => 'John Wick', 'preferred_shift' => 'afternoon']);
        $response->assertStatus(422);
    }


    public function testDestoryEmploy(){
        $testData = ['name' => 'John Wick', 'preferred_shift' => 'day'];
        $testData = EmployeersModel::create($testData);
        $response = $this->deleteJson('/api/employee/'.$testData->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('employeers', ['id' => $testData->id]);
    }
   
    

}