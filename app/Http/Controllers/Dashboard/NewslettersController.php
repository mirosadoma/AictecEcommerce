<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\NewslettersExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Newsletters\Newsletter;
use Maatwebsite\Excel\Facades\Excel;

class NewslettersController extends Controller {

    public function index() {
        if (!permissionCheck('newsletters.view')) {
            return abort(403);
        }
        $lists = Newsletter::orderBy('id', "DESC")->paginate();
        return view('admin.newsletters.index',get_defined_vars());
    }

    public function export()
    {
        return Excel::download(new NewslettersExport, 'newsletters.xlsx');
    }
}
