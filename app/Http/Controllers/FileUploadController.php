<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\FileUploadRequest;
use App\Jobs\Upload\ProcessMobileNumbers;
use App\Models\MobileNumber;
use Illuminate\Support\Facades\DB;

class FileUploadController extends Controller
{
    public function uploadFile(FileUploadRequest $fileUploadRequest)
    {
        $fileName = time() . '.' . $fileUploadRequest->excelFile->extension();

        // Generate a unique file name
        $fileName = time() . '.' . $fileUploadRequest->file('excelFile')->getClientOriginalExtension();

        // Move file to public/uploads
        $filePath = $fileUploadRequest->file('excelFile')->move(public_path('uploads'), $fileName);

        // Dispatch job with the file path
        ProcessMobileNumbers::dispatch($filePath->getPathname());
        return response()->json(['message' => 'File uploaded and processing started.']);
    }
    public function get()
    {
        dd(MobileNumber::count());
    }
}
