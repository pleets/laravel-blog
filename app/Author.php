<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'author_id';

    public function posts()
    {
        return $this->hasMany(Post::class, $this->primaryKey);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
