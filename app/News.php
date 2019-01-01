<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class News extends Model
{
    use SearchableTrait;

    protected $fillable = ['title', 'content', 'hero_img', 'slug','user_id'];

    protected $searchable = [
        'columns' => [
            'news.title' => 10,
            'news.content' => 10,
            'users.name' => 5,
            'users.email' => 2,
        ],
        'joins' => [
            'users' => ['news.user_id', 'users.id']
        ]
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
