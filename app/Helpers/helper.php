<?php
use Illuminate\Support\Str;

if (!function_exists('editSlug')) {
    function editSlug($text = ""){
        return Str::slug($text);
    }
}

if (!function_exists('app_settings')) {
    function app_settings(){
        static $settings = null;
        if ($settings == null) {
            $settings = \App\Models\Settings\SiteConfig::first();
        }
        return $settings;
    }
}

if (!function_exists('app_social')) {
    function app_social(){
        static $social = null;
        if ($social == null) {
            $social = \App\Models\Settings\SiteSocial::get();
        }
        return $social;
    }
}

if (!function_exists('getRightNavbar')) {
    function getRightNavbar()
    {
        $glob = glob(app_path() . '/Helpers/INC/Menu.php');
        $f = collect($glob)->groupBy(
            function ($el) {
                return pathinfo($el)['filename'];
            }
        );
        $f = include $glob[0];
        $orderNum = $f;
        $checkRoles = [];
        foreach ($orderNum as $value) {
            array_push($checkRoles, $value);
        }
        $array = bubbleSort($checkRoles);
        return $array;
    }
}

if (!function_exists('bubbleSort')) {
    function bubbleSort($array)
    {
        if (!$length = count($array)) {
            return $array;
        }
        for ($outer = 0; $outer < $length; $outer++)
        {
            for ($inner = 0; $inner < $length; $inner++)
            {
                if ($array[$outer]['order'] < $array[$inner]['order'])
                {
                    $tmp = $array[$outer];
                    $array[$outer] = $array[$inner];
                    $array[$inner] = $tmp;
                }
            }
        }
        return $array;
    }
}

if (!function_exists('admin_can_any')) {
    function admin_can_any($table)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if(str_contains($value, $table)){
                $ch = 'true';
            }
        }
        return $ch;
    }
}
if (!function_exists('admin_can_item')) {
    function admin_can_item($table, $val)
    {
        $user_permissions = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        $ch = 'false';
        foreach ($user_permissions as $value) {
            if($value == $table.'.'.$val){
                $ch = 'true';
            }
        }
        return $ch;
    }
}

if (!function_exists('get_permissions')) {
    function get_permissions() {
        $glob = glob(app_path() . '/Helpers/INC/Permission.php');
        $array = include $glob[0];
        return $array;
    }
}

if (!function_exists('getReports')) {
    function getReports() {
        $glob = glob(app_path() . '/Helpers/INC/Main.php');
        $array = include $glob[0];
        return $array;
    }
}

if (!function_exists('permissionCheck')) {
    function permissionCheck($permission)
    {
        if (\Auth::guard('admin')->user() && \Auth::guard('admin')->user()->roles->first() && \Auth::guard('admin')->user()->roles->first()->permissions) {
            return in_array($permission,\Auth::guard('admin')->user()->roles->first()->permissions->pluck('name')->toArray());
        }else {
            return false;
        }
    }
}

if (!function_exists('app_languages')) {
    function app_languages()
    {
        $languages = config('laravellocalization.supportedLocales');
        return $languages;
    }
}

if (!function_exists('SubmitButton')) {
    function SubmitButton($title)
    {
        return "<button type=\"submit\" class=\"btn btn-primary pull-right\" style=\" top: 8px; \">".__($title)."<i class=\"icon-floppy-disk position-right\"></i></button>";
    }
}

if (!function_exists('BackButton')) {
    function BackButton($title, $route)
    {
        return "<a href=\"{$route}\" class=\"btn btn-secondary pull-right\" style=\" top: 8px; \">".__($title)."</a>";
    }
}

if (!function_exists('assetAdmin')) {
    function assetAdmin($value, $type = 'css')
    {
        return ($type == 'css') ? '<link href="'.env("APP_URL").'assets/admin/' . $value . '" rel="stylesheet" type="text/css">' : '<script src="'.env("APP_URL").'assets/admin/' . $value . '"></script>';
        // return ($type == 'css') ? '<link href="/assets/admin/' . $value . '" rel="stylesheet" type="text/css">' : '<script src="/assets/admin/' . $value . '"></script>';
    }
}

if (!function_exists('assetSite')) {
    function assetSite($value, $type = 'css')
    {
        return ($type == 'css') ? '<link href="/website/' . $value . '" rel="stylesheet" type="text/css">' : '<script src="/website/' . $value . '"></script>';
    }
}

if (!function_exists('table_width_head')) {
    function table_width_head($count)
    {
        return "style=\"text-align:right;width: calc({$count} * 25px);\"";
    }
}

if (!function_exists('contactTypes')) {
    function contactTypes()
    {
        return [
            'email' => 'البريد الإلكترونى',
            'phone' => 'الهاتف',
            'mobile' => 'الجوال',
            'fax' => 'الفاكس',
            'mail' => 'صندوق البريد',
            'address' => 'العنوان',
            'whats' => 'واتس اب',
            'facebook' => 'فيس بوك',
            'twitter' => 'تويتر',
            'google' => 'جوجل بلس',
            'youtube' => 'يوتيوب',
            'instagram' => 'انستجرام',
            'linkedin' => 'لينك ان',
            'snapchat-ghost' => 'سناب شات'
        ];
    }
}

if (!function_exists('contactIcons')) {
    function contactIcons()
    {
        return [
            'email' => 'fas fa-envelope',
            'phone' => 'fas fa-phone',
            'mobile' => 'fas fa-mobile-alt',
            'fax' => 'fas fa-fax',
            'mail' => 'fas fa-envelope',
            'address' => 'fas fa-map-marker-alt',
            'whats' => 'fab fa-whatsapp',
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'google' => 'fab fa-google-plus-g',
            'youtube' => 'fab fa-youtube',
            'instagram' => 'fab fa-instagram',
            'linkedin' => 'fab fa-linkedin-in',
            'snapchat-ghost' => 'fab fa-snapchat-ghost',
        ];
    }
}

if (!function_exists('generate_code')) {
    function generate_code()
    {
        return random_int(1000, 9999);
        // return 1234;
    }
}

// if (!function_exists('api_response')) {
//     function api_response($msg = '' , $data = [] , $pagination = null ){
//         if ( $data == [] ){
//             return [
//                 'message'   => $msg ,
//                 'data'      => []
//             ];
//         }
//         if ($pagination == null ){
//             return [
//                 'message'   => $msg ,
//                 'data'      => $data
//             ];
//         }else{
//             return [
//                 'message'   => $msg ,
//                 'data'      => $data ,
//                 'pagination' => [
//                     'total' => $pagination->total(),
//                     'count' => $pagination->count(),
//                     'perPage' => $pagination->perPage(),
//                     'currentPage' => $pagination->currentPage(),
//                     'lastPage' => $pagination->lastPage(),
//                     'hasMorePages' => $pagination->hasMorePages(),
//                 ]
//             ];
//         }

//     }
// }

if (!function_exists('api_msg')) {
    function api_msg($request,$ar,$en){
        if($request->header('Accept-Language') == "ar"){
            app()->setLocale('ar');
            $msg = $ar;
        }else{
            app()->setLocale('en');
            $msg = $en;
        }
        return $msg ;
    }
}

if (!function_exists('check_locale')) {
    function check_locale($ar,$en){
        if(app()->getLocale() == "ar"){
            app()->setLocale('ar');
            $msg = $ar;
        }else{
            app()->setLocale('en');
            $msg = $en;
        }
        return $msg ;
    }
}

if (!function_exists('api_model_set_paginate')) {

    function api_model_set_paginate($model)
    {
        return [
            'total'         => $model->total(),
            'count'         => $model->count(),
            'perPage'       => $model->perPage(),
            'currentPage'   => $model->currentPage(),
            'lastPage'      => $model->lastPage(),
            'hasMorePages'  => $model->hasMorePages(),
        ];
    }
}


if (!function_exists('get_server_ip')) {
    function get_server_ip() {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip();
    }
}
