<?php

namespace App\Livewire\Teacher\Attendace;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;
use Masmerise\Toaster\Toaster;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;

class AttendacePage extends Component
{
    public $year, $month, $grade, $current_year;
    public $students = [];
    public $attendances = [];
    public $grades = [];
  
    public function mount(){
        $this->grades = Grade::all();
    }

    public function fetchStudents(){
        if ($this->month && $this->year && $this->grade) {
                $this->students = Student::where('grade_id', $this->grade)->get();
                foreach ($this->students as $key => $value) {
                    # code...
                    foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
                        # code...
                        $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                        $this->attendances[$value->id][$day] = Attendance::where('student_id', $value->id)
                            ->whereDate('date', $date)
                            ->value('status') ?? 'present';
                    }
                }
            # code...
        }
    }

    public function updateAttendance($studentID, $day, $status){
        $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
        $attendance = Attendance::updateOrCreate(
            ['student_id' => $studentID, 'date' => $date],
            ['status' => $status, 'grade_id' => $this->grade]
        );
        $this->attendances[$studentID][$day] = $status;
        Toaster::success('Attendance for date ' . $date . ' updated successfully for '.$studentID);
    }

    public function markAll($day, $status){
        foreach ($this->students as $student) {
            $this->updateAttendance($student->id, $day, $status);
        }
        Toaster::success('All students attendance for date ' . Carbon::create($this->year, $this->month, $day)->format('Y-m-d') . ' updated successfully');

    }

    public function exportToExcel(){
        return Excel::download(new AttendanceExport($this->year, $this->month, $this->grade), 'attendance.xlsx');
    }

    public function render()
    {
        $this->fetchStudents();
        $current_year = Carbon::now()->format('Y');
        $this->current_year = $current_year;
        return view('livewire.teacher.attendace.attendace-page',[
            'current_year'=>$current_year,
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth,
        ]);
    }
}
