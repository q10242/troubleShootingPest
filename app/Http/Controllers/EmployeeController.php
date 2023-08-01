<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeersModel;
use App\Http\Requests\EmloyeeRequest;
class EmployeeController extends Controller
{
    public function create(EmloyeeRequest $request)
    {
        $validated = $request->validated();
        $employee = EmployeersModel::create($validated);
        return response()->json($employee, 201);
    }

    public function index()
    {
        $employee = EmployeersModel::all();
        return response()->json($employee, 200);
    }

    public function update(EmloyeeRequest $request, $id)
    {
        $employee = EmployeersModel::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
        $validated = $request->validated();
        $employee->update($validated);
        return response()->json($employee, 200);
    }

    public function delete($id)
    {
        $employee = EmployeersModel::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }
        $employee->delete();
        return response()->json(['message' => 'Employee deleted.'], 200);
    }
}
