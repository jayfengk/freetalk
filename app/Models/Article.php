<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    //多對一
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    // fillable 保護機制
    protected $fillable = ['title', 'content'];
    //一對多
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
