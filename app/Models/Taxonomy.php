<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model implements SluggableInterface
{
    use SluggableTrait;

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopeCategory($query)
    {
        return $query->where('type','category');
    }

    public function scopeTag($query)
    {
        return $query->where('type','tag');
    }
}
