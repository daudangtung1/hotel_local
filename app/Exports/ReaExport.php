<?php

namespace App\Exports;

use App\Models\BookingRoom;
use App\Models\RevenueAndExpenditure;
use App\Models\Room;
use App\Repositories\BookingRoomRepository;
use App\Repositories\RevenueAndExpenditureRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ReaExport implements WithHeadings, FromCollection, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tiêu đề',
            'Số tiền',
            'Phân loại',
            'Người tạo',
            'Ngày tạo',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RevenueAndExpenditureRepository::instance()->filter($this->request, false);
    }

    /**
     * @var Invoice $invoice
     */
    public function map($data): array
    {
        return [
            $data->id ?? '',
            $data->name ?? '',
            get_price($data->money ?? 0, 'đ'),
            \App\Models\RevenueAndExpenditure::STATUS[$data->type],
            $data->user->name ?? '',
            $data->created_at ?? '',
        ];
    }

}
