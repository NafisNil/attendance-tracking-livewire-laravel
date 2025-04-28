<?php

namespace App\Livewire\Teacher\Students;

use Livewire\Component;
use App\Models\Student;
use Masmerise\Toaster\Toaster;
class StudentList extends Component
{
    public function delete($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            Toaster::success('Student deleted successfully!');
            return redirect()->route('student.index');
        }else{
            Toaster::error('Student not found!');
            return redirect()->route('student.index');
        }
    }
    public function render()
    {
        return view('livewire.teacher.students.student-list',[
            'students'=>Student::all()
        ]);
    }
}
