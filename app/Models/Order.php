<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasManyThrough(ShiftWorker::class, User::class, "id", "id", "user_id", "shift_worker_id");
    }


    public function positions()
    {
        return $this->hasMany(OrderMenu::class, "order_id");
    }

    public function table()
    {
        return $this->belongsTo(Table::class,);
    }

    public function statusOrder()
    {
        return $this->belongsTo(StatusOrder::class, "status_order_id");
    }


    public function getPrice()
    {
        $total = 0;
        for ($i = 0; $i < count($this->positions); $i++) {
            $total += $this->positions[$i]->menu->price * $this->positions[$i]->count;
        }
        return $total;
    }
}
