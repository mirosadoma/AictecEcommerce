<?php

namespace App\Exports;

use App\Models\Orders\Order;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\Sheets\OrdersPerMonthSheet;

class OrdersExport implements WithMultipleSheets
{
    use Exportable;

    protected $year;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new OrdersPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
