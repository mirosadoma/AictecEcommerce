<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Questions\Question;
// Requests
use App\Http\Requests\Dashboard\Questions\StoreRequest;
use App\Http\Requests\Dashboard\Questions\UpdateRequest;

class QuestionsController extends Controller {

    public function index() {
        if (!permissionCheck('common_questions.view')) {
            return abort(403);
        }
        $lists = Question::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('question') && !empty(request('question'))) {
                $lists->whereTranslationLike("question","%".request('question')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('admin.common_questions.index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('common_questions.create')) {
            return abort(403);
        }
        return view('admin.common_questions.create',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('common_questions.create')) {
            return abort(403);
        }
        $data = $request->all();
        $data['is_active']      = 1;
        Question::create($data);
        return redirect()->route('app.common_questions.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($question) {
        if (!permissionCheck('common_questions.update')) {
            return abort(403);
        }
        $question = Question::find($question);
        return view('admin.common_questions.edit',get_defined_vars());
    }

    public function update(UpdateRequest $request, $question) {
        if (!permissionCheck('common_questions.update')) {
            return abort(403);
        }
        $question = Question::find($question);
        $question->update($request->all());
        return redirect()->route('app.common_questions.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($question) {
        if (!permissionCheck('common_questions.delete')) {
            return abort(403);
        }
        $question = Question::find($question);
        $question->delete();
        return redirect()->route('app.common_questions.index')->with('success', __('Data Deleted Successfully'));
    }
    public function is_active($question)
    {
        $question = Question::find($question);
        if ($question->is_active == 0) {
            $question->update(['is_active' => 1]);
        }else{
            $question->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }
}
