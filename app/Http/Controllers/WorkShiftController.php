<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\WorkShiftRequest;
use App\Models\WorkShift;
use Illuminate\Http\Request;

class WorkShiftController extends Controller
{
    public function create(WorkShiftRequest $work)
    {
        $w = WorkShift::create($work->all());
        $data = [

            "id" => $w->id,
            "start" => $w->start,
            "end" => $w->end,

        ];
        return response()->json($data, 201);
    }

    public function open($work)
    {
        $w = WorkShift::where("active", 1)->first();

        if ($w) {
            throw new ApiException(403, 'Forbidden. There are open shifts!');
        }

        $wo = WorkShift::where('id', $work)->first();

        $wo->active = 1;
        $wo->save();

        $data = [
            "data" => [
                "id" => $wo->id,
                "start" => $wo->start,
                "end" => $wo->end,
                "active" => true
            ]
        ];
        return response()->json($data,);
    }

    public function close($work)
    {
        $w = WorkShift::where(['id' => $work, 'active' => 1])->first();

        if (!$w) {
            throw new ApiException(403, 'Forbidden. The shift is already closed!');
        }


        $w->active = 0;
        $w->save();

        $data = [
            "data" => [
                "id" => $w->id,
                "start" => $w->start,
                "end" => $w->end,
                "active" => false,
            ]
        ];
        return response()->json($data,);
    }
}
