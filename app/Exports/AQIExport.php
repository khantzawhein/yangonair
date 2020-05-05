<?php

namespace App\Exports;

use App\aqitemp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\sensor;

class AQIExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $db = aqitemp::all();
        $db->transform(function ($item) {
            unset($item->updated_at);
            return $item;
        });
        return $db;
    }
    public function map($AQI): array {
        return [
            $AQI->id, $AQI->sensor0, $AQI->sensor1, $AQI->sensor2, $AQI->sensor3, $AQI->sensor4, $AQI->sensor5, $AQI->sensor6, $AQI->sensor7, $AQI->sensor8, $AQI->sensor9, $AQI->sensor10, $AQI->overall, Date::dateTimeToExcel($AQI->created_at)
        ];
    }
    public function headings():array {
        $sensor_db = sensor::select('sensor_name')->get();
        $row_name = collect([]);
        $row_name->push('No.');
        foreach ($sensor_db as $row) {
            $row_name->push($row->sensor_name);
        }
        $row_name->push('overall');
        $row_name->push('timestamp');
        return $row_name->all();
    }
    public function columnFormats(): array {
        $column = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'];
        $return_arr = array_fill_keys($column, '0');
            $return_arr['N'] = 'dd-mm-yy hh:mm:ss AM/PM';
        return $return_arr;
    }
}
