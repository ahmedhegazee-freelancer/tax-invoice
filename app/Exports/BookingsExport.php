<?php

namespace App\Exports;

use App\DataTransferObjects\BookingExportDto;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Booking\Entities\Booking;

class BookingsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    public function __construct(private BookingExportDto $dto)
    {
    }
    public function headings(): array
    {
        return [
            '#',
            'Race',
            'Name',
            'Phone',
            'Participant',
            'Gender',
            'Age Group',
            'Start time',
            'Distance',
            'Price',
            'Date',
        ];
    }
    public function query()
    {
        return Booking::query()
            ->with(['race:id', 'race.translations:title,race_id'])
            ->raceSearch($this->dto->raceID)
            ->rangeSearch($this->dto->dateRange)
            ->status($this->dto->status)
            ->orderByDesc('id')
            ->limit(2000);
    }
    /**
     * @var Invoice $invoice
     */
    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->race->translations->first()->title ?? "",
            $booking->owner_name,
            $booking->owner_phone,
            $booking->participant_name,
            \get_gender($booking->gender_id),
            $booking->age_group,
            $booking->start_time,
            $booking->distance,
            $booking->price,
            $booking->created_at,
        ];
    }
}