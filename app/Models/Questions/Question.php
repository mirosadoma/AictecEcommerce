<?php

namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Question extends Model {

    use Translatable;
    protected $table = "common_questions";
    protected $translationForeignKey = "question_id";
    public $translatedAttributes = ['question','answer'];
    public $translationModel = 'App\Models\Questions\Translation\Question';
    protected $guarded = ['id'];
}
