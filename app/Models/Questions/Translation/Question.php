<?php

namespace App\Models\Questions\Translation;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "common_questions_translations";
    protected $fillable = ['question','answer'];
    protected $guarded = ['question_id'];
    public $timestamps = false;
}
