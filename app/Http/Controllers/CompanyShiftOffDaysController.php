<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommonIdOnlyRequest;
use App\Http\Requests\CompanyShiftOffDaysRequest;
use App\Models\CompanyShiftOffDaysModel;

class CompanyShiftOffDaysController extends Controller {
    public function create(CompanyShiftOffDaysRequest $request) {
        $validated = $request->validated();
        $companyShiftOffDays = CompanyShiftOffDaysModel::create($validated);
        return response()->json($companyShiftOffDays, 201);
    }

    public function delete( $id) {
        if (!CompanyShiftOffDaysModel::destroy($id)) {
            return response()->json(['error' => 'Company shift off days not found.'], 404);
        }
        return response()->json(null, 204);
    }

    public function index() {
        return response()->json(CompanyShiftOffDaysModel::all());
    }
}
