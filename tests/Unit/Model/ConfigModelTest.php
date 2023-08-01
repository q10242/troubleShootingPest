<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ConfigModel;

class ConfigModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "config" table is associated with the model.
     *
     * @return void
     */
    public function testConfigModelTable()
    {
        $config = new ConfigModel();
        $this->assertEquals('config', $config->getTable());
    }

    /**
     * Test if the "key" and "value" attributes are fillable in the model.
     *
     * @return void
     */
    public function testConfigModelFillable()
    {
        $config = new ConfigModel();
        $fillable = ['key', 'value'];

        $this->assertEqualsCanonicalizing($fillable, $config->getFillable());
    }
}
