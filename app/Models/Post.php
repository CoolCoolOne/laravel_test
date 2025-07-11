<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     * 
     * 
     */
    protected $fillable = [
        'title',
        'content',
        'color',
        'personal',
        'user_id',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPersonal()
    {
        return $this->personal ? 'Личное':'Для всех';
    }

    public function getShortContent()
    {
        $shortContent = Str::limit($this->content, 15);
        return $shortContent;
    }

    


}
