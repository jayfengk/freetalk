<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //多對一
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    //多對一
    public function article() {
        return $this->belongsTo('App\Models\Article');
    }
    // fillable 保護機制
    protected $fillable = ['content'];
}
