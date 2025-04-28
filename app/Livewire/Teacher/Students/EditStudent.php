<?php

namespace App\Livewire\Teacher\Students;
use Livewire\Component;
use App\Models\Grade;
use App\Models\Student;
use Masmerise\Toaster\Toaster;

class EditStudent extends Component
{
    public $grades = [];
    public $first_name;
    public $last_name;
    public $age;
    public $grade;
    public $student_details;
    public function mount($id){
        $this->student_details = Student::find($id);
        $this->fill([
            'first_name' => $this->student_details->first_name,
            'last_name' => $this->student_details->last_name,
            'age' => $this->student_details->age,
            'grade' => $this->student_details->grade_id,
        ]);
        $this->grades = Grade::all();
    }

    public function update(){
        $this->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'age'=>'required|integer|min:1|max:100',
            'grade'=>'required|exists:grades,id',
        ]);

       $student =  Student::find($this->student_details->id)->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'grade_id' => $this->grade,
        ]);

        Toaster::success('Student updated successfully!');
        return redirect()->route('student.index');
    }

    public function render()
    {

        return view('livewire.teacher.students.edit-student');
    }
}
