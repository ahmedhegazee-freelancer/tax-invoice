<?php

namespace App\Imports;

use App\Models\InvoiceItem;
use App\Services\InvoiceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class InvoiceItemsImport implements ToModel, WithBatchInserts, WithChunkReading, ShouldQueue
{
    public function __construct(public int $branchID)
    {
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] == 'ID') {
            return null;
        }
        // if (!($row[4] > InvoiceService::make()->getLastInvoiceItemDate()))
        //     return null;
        return new InvoiceItem([
            'item_id'       => $row[2],
            'ticket_id'     => $row[81],
            'name'          => $row[9],
            'quantity'      => $row[7],
            'price'         => $row[18],
            'sub_total'     => $row[22],
            'total'         => $row[32],
            'discount'      => $row[24],
            'create_date'   => now(),
            'branch_id' => $this->branchID
        ]);
    }
    public function chunkSize(): int
    {
        return 100;
    }
    public function batchSize(): int
    {
        return 100;
    }
}