<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use \Maatwebsite\Excel\Concerns\ToCollection;
use \Maatwebsite\Excel\Concerns\OnEachRow;
use \Maatwebsite\Excel\Concerns\WithChunkReading;
use \Maatwebsite\Excel\Row;
use Modules\Result\Entities\Result;
use Modules\Result\Entities\ResultItem;

class ResultImport implements OnEachRow
{
    public function __construct(private int $raceID)
    {
    }
    public function onRow(Row $row)
    {

        $row = $row->toArray();

        if (\strlen($row[0]) == 0 && \strlen($row[1]) == 0 && \strlen($row[2]) == 0) {
            return;
        }
        if (\strlen($row[0]) == 0 && \strlen($row[1]) == 0 && \strlen($row[2]) > 0) {
            Result::create([
                'race_id' => $this->raceID,
                'name' => $row[2]
            ]);
            return;
        }

        if ($row[0] == 'Place')
            return;
        $result = Result::where('race_id', $this->raceID)->latest()->orderByDesc('id')->first();

        ResultItem::create([
            'result_id' => $result->id,
            'place' => $row[0],
            'bib_name' => $row[1],
            'name' => $row[2],
            'first_name' => $row[3],
            'last_name' => $row[4],
            'team_name' => $row[5],
            'team_name_2' => $row[6],
            'distance' => $row[7],
            'category' => $row[8],
            'age' => $row[9],
            'gender' => $row[10],
            'time' => $row[11],
            'difference' => $row[12],
            'back' => $row[13],
            'winning' => $row[14],
            'average' => $row[15],
            'median' => $row[16],
        ]);
    }
}