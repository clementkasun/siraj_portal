<?php

namespace App\Exports;

use App\models\JsonResult;
use Maatwebsite\Excel\Concerns\FromCollection;

class JsonImport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return JsonResult::all();
    }
}
