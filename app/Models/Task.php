<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_at',
        'end_at',
        'priority',
        'user_id',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
