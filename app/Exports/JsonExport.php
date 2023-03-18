<?php

namespace App\Exports;

use App\Models\TestJson;
use App\Models\JsonResult;
use Illuminate\Support\Collection;
use App\Http\Controllers\TestJsonController;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class JsonExport implements FromCollection, WithHeadings
{
    private  $testJson;
    private $surveyId;
    public function __construct($surveyId)
    {
        // dd($surveyId);
        $testJsonController = new TestJsonController();
        $this->testJson = $testJsonController->getASurvey($surveyId);
        $this->surveyId = $surveyId;
        // dump(memory_get_usage());
        ini_set('memory_limit', '-1');
        // dd($this->testJson); 

    }




    public function collection()
    {
        // dump(memory_get_usage());
        $queary = JsonResult::query();
        $queary = $queary->where('survey_id', $this->surveyId)->get()->toArray();
        $d = [];
        foreach ($queary as $row) {
            // ini_set('memory_limit', '-1');
            $q = [];
            foreach ($row['data'] as $data) {
                foreach ($data['objects'] as $object) {
                    if (!array_key_exists('answer', $object)) {
                        $object['answer'] = '';
                    }
                    if (is_array($object['answer'])) {
                        if (count($object['answer']) > 1) {
                        }
                        $object['answer'] = array_flatten($object['answer']);
                        array_push($q,  implode(", ", $object['answer']));
                    } else {
                        array_push($q,  $object['answer']);
                    }
                }
            }
            array_push($d, $q);
        }
        // ini_set('memory_limit', '-1');
        // dump(memory_get_usage());
        unset($queary);
        // dump(memory_get_usage());
        return new Collection([$d]);
    }
    public function headings(): array
    {

        $this->testJson = $this->testJson['data'];
        $d = [];
        foreach ($this->testJson as $row) {
            $q = [];
            foreach ($row['objects'] as $object) {
                array_push($d, $object['title'] . " - " . $object['no']);
            }
        }
        // dump(memory_get_usage());
        unset($this->testJson);
        // dump(memory_get_usage());
        return $d;
    }
}
