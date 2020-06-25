<?php

namespace App\Http\Controllers;

use App\Services\IndicatorService;
use Illuminate\Http\Request;
use App\Indicator;
use Illuminate\Support\Facades\Validator;

/**
 * Class IndicatorController
 *
 * @package App\Http\Controllers
 */
class IndicatorController extends Controller
{
    /**
     * @return \App\Indicator[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Indicator::all();
    }

    /**
     * @param int $id
     * @return \App\Indicator
     */
    public function show(int $id)
    {
        return Indicator::find($id, ['value']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'type' => 'required|in:string,alphanumeric,guid,integer',
            'length' => 'required|numeric|digits_between:1,4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ], 400);
        }

        try {
            $indicator = new Indicator();
            $indicator->type = $request->input('type');
            $indicator->length = $request->input('length');
            $indicator->value = IndicatorService::generateIndicatorValue($fields);
            $indicator->save();
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => sprintf('Failed to insert data into database: %s', $exception),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'id' => $indicator->id,
            'value' => $indicator->value,
            'message' => 'Indicator was saved',
        ], 201);
    }
}
