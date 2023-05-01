<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;

class BookingExportDto
{
    public function __construct(
        public ?int $raceID,
        public ?bool $status,
        public ?array $dateRange
    ) {
    }
    public static function create(Request $request)
    {
        return new self(
            $request->get('race'),
            $request->get('status'),
            $request->get('range'),
        );
    }
}