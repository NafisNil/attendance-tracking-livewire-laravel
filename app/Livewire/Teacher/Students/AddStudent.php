<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Attendance Management - Add Student')]
class AddStudent extends Component
{
    public $first_name;
    public $last_name;
    public $age;
    public $grade;
    public $grades = [];
    public function mount(){
        $this->grades = Grade::all();
    }
    public function save(){
        $this->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'age'=>'required|integer|min:1|max:100',
            'grade'=>'required|exists:grades,id',
        ]);

        Student::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'grade_id' => $this->grade,
        ]);

        $this->reset();
        Toaster::success('Student added successfully!');
        return redirect()->route('student.index');
    }
    public function render()
    {
        return view('livewire.teacher.students.add-student');
    }
}
