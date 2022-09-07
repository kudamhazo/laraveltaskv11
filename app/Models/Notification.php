<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
