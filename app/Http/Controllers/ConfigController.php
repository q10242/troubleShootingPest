<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Models\ConfigModel;

class ConfigController extends Controller
{
    public function create(ConfigRequest $request) {
        $validated = $request->validated();
        $Config = ConfigModel::create($validated);
        return response()->json($Config, 201);
    }

    public function delete( $id) {
        if (!ConfigModel::destroy($id)) {
            return response()->json(['error' => 'Company shift off days not found.'], 404);
        }
        return response()->json(null, 204);
    }

    public function index() {
        return response()->json(ConfigModel::all());
    }
}
