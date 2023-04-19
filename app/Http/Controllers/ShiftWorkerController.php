<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\ShiftWorkerRequest;
use App\Models\ShiftWorker;
use App\Models\WorkShift;
use Illuminate\Http\Request;

class ShiftWorkerController extends Controller
{
    public function create(ShiftWorkerRequest $shift, WorkShift $work)
    {

        $s = ShiftWorker::where(["work_shift_id" => $work->id, "user_id" => $shift->user_id])->first();
        if ($s) {
            throw new ApiException(403, "Forbidden. The worker is already on shift!");
        }

        $s = ShiftWorker::create(["work_shift_id" => $work->id, "user_id" => $shift->user_id]);

        $data = ["data" => ["id_user" => $shift->user_id, "status" => "added"]];

        return response()->json($data, 201);

    }
}
