<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeShiftOffModel;
use App\Models\EmployeersModel;
use App\Http\Requests\EmloyeeShiftOffRequest;
class EmployeeShiftOffController extends Controller
{
    public function create(EmloyeeShiftOffRequest $request)
    {

        $validated = $request->validated();
        $employeeShiftOff = EmployeeShiftOffModel::create($validated);
        return response()->json($employeeShiftOff, 201);
    }

    public function index()
    {
        $employeeShiftOff = EmployeeShiftOffModel::all();
        return response()->json($employeeShiftOff, 200);
    }

    public function update(EmloyeeShiftOffRequest $request, $id)
    {
        $employeeShiftOff = EmployeeShiftOffModel::find($id);
        if (!$employeeShiftOff) {
            return response()->json(['error' => 'Employee shift off days not found.'], 404);
        }
        $validated = $request->validated();
        $employeeShiftOff->update($validated);
        return response()->json($employeeShiftOff, 200);
    }

    
}
