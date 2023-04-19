<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function orders()
    {
        return $this->hasManyThrough(Order::class, ShiftWorker::class, "work_shift_id", "shift_worker_id");
    }


    public function getPrice()
    {
        $total = 0;
        for ($i = 0; $i < count($this->orders); $i++) {
            $total += $this->orders[$i]->getPrice();
        }
        return $total;
    }

}
