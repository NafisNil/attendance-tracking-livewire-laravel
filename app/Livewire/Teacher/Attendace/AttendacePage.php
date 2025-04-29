<?php

namespace App\Livewire\Teacher\Attendace;

use Livewire\Component;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Attendance;
use Carbon\Carbon;

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
    public function render()
    {
        $current_year = Carbon::now()->format('Y');
        $this->current_year = $current_year;
        return view('livewire.teacher.attendace.attendace-page',[
            'current_year'=>$current_year,
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth,
        ]);
    }
}
