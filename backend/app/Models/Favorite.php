<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function isFavorite(Int $user_id, Int $task_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('task_id', $task_id)->first();
    }

    public function storeFavorite(Int $user_id, Int $task_id)
    {
        $this->user_id = $user_id;
        $this->task_id = $task_id;
        $this->save();
        return;
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
