<?php

namespace App\Models;

use App\Repositories\Parse;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $fillable = ['title', 'content'];

    protected $appends = ['parsed_content'];

    public function getParsedContentAttribute()
    {
        return Parse::render($this->content);
    }

    public function examples()
    {
        return $this->hasMany(Example::class);
    }
}
