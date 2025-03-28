<?php

namespace App\Jobs\Upload;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MobileNumbersImport;
use Illuminate\Support\Facades\Log;

class ProcessMobileNumbers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        if (!file_exists($this->filePath)) {
            Log::error('File not found: ' . $this->filePath);
            return;
        }
        try {
            Excel::import(new MobileNumbersImport, $this->filePath);
            Log::info("File processed successfully: {$this->filePath}");
            unlink($this->filePath);
        } catch (\Exception $e) {
            Log::error('File processing failed: ' . $e->getMessage());
        }
    }

    public function failed($exception)
    {
        Log::error('Job failed: ' . $exception->getMessage());
    }
}
