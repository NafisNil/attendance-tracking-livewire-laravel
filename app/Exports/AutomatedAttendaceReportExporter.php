<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;

class AutomatedAttendaceReportExporter implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate, $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Attendance::whereBetween('date', [$this->startDate, $this->endDate])
            ->get();
    }

    public function map($row): array {
        return [
            $row->student->first_name.' '. $row->student->last_name,
            $row->date,
            ucfirst($row->status),
            $row->reason ?? 'N/A'
        ];
    }

    public function headings(): array {
        return [
            'Student Name',
            'Date',
            'Status',
            'Reason'
        ];
    }
}
