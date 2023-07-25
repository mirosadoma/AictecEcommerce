<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Settings\Models\SiteConfig;
use App\Models\Chat;
use App\Models\User;
use App\Components\Orders\Models\Order;

class MainController extends Controller {

    public function index() {
        return view('admin.index',get_defined_vars());
    }
    public function maintenance() {
        return view('admin.maintenance',get_defined_vars());
    }
}
