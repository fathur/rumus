<?php

namespace App\Models;

use App\Repositories\Parse;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $fillable = ['question','answer'];

    protected $appends = ['parsed_question','parsed_answer'];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getParsedQuestionAttribute()
    {
        return Parse::render($this->question);
    }

    public function getParsedAnswerAttribute()
    {
        return Parse::render($this->answer);
    }
}
