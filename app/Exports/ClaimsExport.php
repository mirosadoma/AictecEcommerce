<?php

namespace App\Exports;

use App\Models\Claims\Claim;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClaimsExport implements FromView
{
    public function view(): View
    {
        $all_data = [];
        $claims = Claim::all();
        foreach ($claims as $value) {
            $all_data[] = $this->one_object($value);
        }
        return view('exports.claims', [
            'all_data' => $all_data
        ]);
    }

    private function one_object($data){
        $all = [
            'id'            => $data->id,
            'claimer'       => $data->claimer->name,
            'name'          => $data->name,
            'email'         => $data->email,
            'phone'         => $data->phone,
            'message'       => $data->message,
            'created_at'    => $data->created_at,
        ];
        if (isset($data->reply)) {
            $all['reply'] = $data->reply;
            $all['reply_date'] = \Carbon\Carbon::parse($data->reply_date)->format('Y-m-d');
            $all['reply_time'] = \Carbon\Carbon::parse($data->reply_date);
            $all['reply_owner'] = $data->reply_owner->name;
        } else {
            $all['reply'] = "";
            $all['reply_date'] = "";
            $all['reply_time'] = "";
            $all['reply_owner'] = "";
        }
        return $all;

    }
}
