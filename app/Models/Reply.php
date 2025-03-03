<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'thread_id', 'is_solution'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function score()
    {
        return $this->votes()->where('is_upvote', true)->count() -
               $this->votes()->where('is_upvote', false)->count();
    }
}
