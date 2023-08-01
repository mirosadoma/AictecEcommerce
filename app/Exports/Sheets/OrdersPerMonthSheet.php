<?php

namespace App\Exports\Sheets;

use App\Components\Orders\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    public function headings(): array
    {
        return [
            '#',
            __('Owner'),
            __('Vendor'),
            __('Payment Type'),
            __('Type'),
            __('Period'),
            __('Total'),
            __('Remaining date'),
            __('Status'),
            __('Created At')
        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Order::query()->orderBy('id', "DESC")->where('status', '<>', Order::STATUS_CART)
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month);
    }

    /**
    * @var Order $order
    */
    public function map($order): array
    {
        return [
            $order->id,
            $order->user->name,
            $order->vendor->name,
            __($order->payment_type),
            __($order->type),
            $order->period ? __($order->period->period) : "-------",
            $order->total .' '. app_settings()->currency,
            $order->remaining_date,
            __($order->status),
            $order->created_at->diffForHumans()
            // \Date::dateTimeToExcel($order->created_at),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return __('Month').' ' . $this->month;
    }
}
