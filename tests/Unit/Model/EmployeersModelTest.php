<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmployeersModel;

class EmployeersModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "employeers" table is associated with the model.
     *
     * @return void
     */
    public function testEmployeersModelTable()
    {
        $employeer = new EmployeersModel();
        $this->assertEquals('employeers', $employeer->getTable());
    }

    /**
     * Test if the "name" and "preferred_shift" attributes are fillable in the model.
     *
     * @return void
     */
    public function testEmployeersModelFillable()
    {
        $employeer = new EmployeersModel();
        $fillable = ['name', 'preferred_shift'];

        $this->assertEqualsCanonicalizing($fillable, $employeer->getFillable());
    }
}
