<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AutomatedAttendaceReportExporter;
use Illuminate\Support\Facades\Mail;
class SendAttendanceReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:send-report {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send daily or monthly attendance report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $type = $this->argument('type');
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        if ($type == 'daily') {
            $startDate = $yesterday;
            $endDate = $today;
            # code...
        }elseif($type == 'weekly'){
            $startDate = $today->copy()->startOfWeek();
            $endDate = $today->copy()->endOfWeek();
        }else{
            $this->error('Invalid type. Please use daily or weekly.');
            return;
        }

        $fileName = "attendance_report_{$type}.xlsx";
        $filePath = "attendance_reports/{$fileName}";

        Excel::store(new AutomatedAttendaceReportExporter($startDate, $endDate), $filePath, 'public');
        Mail::to('nafis@lab-ar.xyz')->send();
    }
}
