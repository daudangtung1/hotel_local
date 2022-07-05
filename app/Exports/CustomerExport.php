<?php

namespace App\Exports;

use App\Models\Customers;
use App\Models\Room;
use App\Repositories\BookingRoomRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CustomerExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        return Customers::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tên khách',
            'CMND/Hộ chiếu',
            'Điện thoại',
            'Địa chỉ',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CustomerRepository::getInstance()->filter($this->request);
    }

    /**
     * @param mixed $data
     *
     * @return array
     */
    public function map($data): array
    {
        $data = $this->collection();
        return [
            $data->id,
            $data->name,
            $data->id_card,
            $data->phone,
            $data->address,
        ];
    }

}
