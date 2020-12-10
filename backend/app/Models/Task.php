<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'task_name',
        'due_date',
        'status'
    ];

    public function user() 
    { 
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    const STATUS = [
        1 => ['name' => '作業中', 'color' =>'blue'],
        2 => ['name' => '完了', 'color' =>'green'],
    ];

    public function getStatusNameAttribute()
    {
        $status = $this->attributes['status'];
        return self::STATUS[$status]['name'];
    }
    public function getStatusColorAttribute()
    {
        $status = $this->attributes['status'];
        return self::STATUS[$status]['color'];
    }

    public function getTimelines()
    {
        return $this->orderby('updated_at','DESC')->simplePaginate(10);
    }
    
    public function getTask(Int $task_id)
    {
        return $this->with('user')->where('id', $task_id)->first();
    }

    public function taskStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->task_name = $data['task_name'];
        $this->due_date = $data['due_date'];
        $this->save();

        return;
    }

    public function getEditTask(Int $user_id, Int $task_id)
    {
        return $this->where('user_id',$user_id)->where('id',$task_id)->first();
    }

    public function taskUpdate(Int $task_id, Array $data)
    {
        $this->id = $task_id;
        $this->task_name = $data['task_name'];
        $this->due_date = $data['due_date'];
        $this->status = $data['status'];
        $this->update();

        return;
    }

    public function taskDestroy(Int $user_id, Int $task_id)
    {
        return $this->where('user_id',$user_id)->where('id',$task_id)->delete();
    }

    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id',$user_id)->orderBy('updated_at','DESC')->simplePaginate(50);
    }

    public function getCompletedTaskCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->where('status',2)->count();
    }

    public function getWorkingTaskCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->where('status',1)->count();
    }


}
