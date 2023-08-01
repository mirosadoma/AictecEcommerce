<?php

namespace App\Exports;

use App\Models\Newsletters\Newsletter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NewslettersExport implements FromView
{
    public function view(): View
    {
        $all_data = [];
        $newsletters = Newsletter::all();
        foreach ($newsletters as $value) {
            $all_data[] = $this->one_object($value);
        }
        return view('exports.newsletters', [
            'all_data' => $all_data
        ]);
    }

    private function one_object($data){
        return [
            'id' => $data->id,
            'email' => $data->email,
            'created_at' => $data->created_at,
        ];

    }
}
