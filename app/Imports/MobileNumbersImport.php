<?php

namespace App\Imports;

use App\Models\MobileNumber;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MobileNumbersImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $batchSize = 1000; // Process in batches of 1000
        $data = [];
        $now = now()->format('Y-m-d H:i:s');

        foreach ($rows as $row) {
            if (isset($row['mobile_number'])) { // Ensure the column exists
                $data[] = [
                    'mobile_number' => trim($row['mobile_number']), // Trim spaces
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (count($data) >= $batchSize) {
                DB::table('mobile_numbers')->insert($data);
                $data = []; // Reset array after insert
            }
        }

        // Insert remaining data
        if (!empty($data)) {
            DB::table('mobile_numbers')->insert($data);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Read in chunks of 1000 rows
    }
}
