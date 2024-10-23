<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Models\Result;

class ExcelDataImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip the header row
        $header = $rows->shift();

        foreach ($rows as $row) {
            // Assuming your Excel columns map to your model's fields in this order
            Result::create([
                'dist_code' => (int)$row[0],
                'dist_name' => $row[1],
                'block_code' => (int)$row[2],
                'block_name' => $row[3],
                'pan_code' => (int)$row[4],
                'pan_name' => $row[5],
                'ward_code' => (int)$row[6],
                'ward' => (string)$row[7],
                'scheme_name' => $row[8],
                'scheme_type' => $row[9],
                'device_code' => (int)$row[10],
                'device_id' => (string)$row[11],
                'status' => $row[12],
                'motor_running_hrs' => (float)$row[13],
                'elec_avi' => (string) $row[14],
                'average_water_discharge_in_KL' =>  (float)$row[15],
            ]);
        }
        
    }
}

