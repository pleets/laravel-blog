<?php

namespace App;

use App\Helpers\Date;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'content',
        'description',
        'image',
        'url_path',
        'url_hash',
        'published_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * @param Builder $query
     * @param string|null $term
     * @param string $boolean
     * @return Builder
     */
    public function scopeTitle(Builder $query, string $term = null, $boolean = 'and'): Builder
    {
        return $query->where('title', 'like', "%{$term}%", $boolean);
    }

    /**
     * @param Builder $query
     * @param string|null $term
     * @param string $boolean
     * @return Builder
     */
    public function scopeDescription(Builder $query, string $term = null, $boolean = 'and'): Builder
    {
        return $query->where('description', 'like', "%{$term}%", $boolean);
    }

    /**
     * @param Builder $query
     * @param string|null $term
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $term = null): Builder
    {
        if (!$term) {
            return $query;
        }

        return $query->title($term, 'or')->description($term, 'or');
    }

}
