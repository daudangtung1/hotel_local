<?php

namespace App\Exports;

use App\Models\BookingRoom;
use App\Models\Room;
use App\Repositories\BookingRoomRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BookingRoomExport implements WithHeadings, FromCollection, WithMapping
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
            'Tên phòng',
            'Tầng',
            'Ngày nhận phòng',
            'Ngày trả phòng',
            'Tình trạng',
            'Thời gian',
            'Phí dịch vụ thuê phòng',
            'Phí dịch vụ',
            'Tổng phí',
            'Ghi chú',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BookingRoomRepository::getInstance()->filter($this->request);
    }

    /**
     * @var Invoice $invoice
     */
    public function map($data): array
    {
        return [
            $data->id,
            $data->room->name ?? '',
            $data->room->floor ?? '',
            Date::dateTimeFromTimestamp($data->start_date ?? ''),
            Date::dateTimeFromTimestamp($data->end_date ?? ''),
            $data->status == 7 ? 'Đã trả phòng' : Room::ARRAY_STATUS[$data->status],
            $data->getTime(true),
            $data->getTotalPrice(false),
            $data->getTotalServices(),
            $data->getTotalPrice(),
            $data->note ?? '',
        ];
    }

}
