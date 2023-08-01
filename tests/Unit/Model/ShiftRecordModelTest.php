<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShiftRecordModel;

class ShiftRecordModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the "shift_record" table is associated with the model.
     *
     * @return void
     */
    public function testShiftRecordModelTable()
    {
        $shiftRecord = new ShiftRecordModel();
        $this->assertEquals('shift_record', $shiftRecord->getTable());
    }

    /**
     * Test if the "shifts" attribute is fillable in the model.
     *
     * @return void
     */
    public function testShiftRecordModelFillable()
    {
        $shiftRecord = new ShiftRecordModel();
        $fillable = ['shifts'];

        $this->assertEqualsCanonicalizing($fillable, $shiftRecord->getFillable());
    }
}
