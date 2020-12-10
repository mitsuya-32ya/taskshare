<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getComments(Int $task_id)
    {
        return $this->with('user')->where('task_id', $task_id)->get();
    }
    
    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->task_id = $data['task_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }
}
