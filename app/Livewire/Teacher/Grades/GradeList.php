<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
class GradeList extends Component
{
    public function delete($id){
        $grade = Grade::find($id);
        if($grade){
            $grade->delete();
            Toaster::success('Grade deleted successfully!');
            return redirect()->route('grade.index');
        }else{
            Toaster::error('Grade not found!');
            return redirect()->route('grade.index');
        }
    }
    public function render()
    {
        return view('livewire.teacher.grades.grade-list',[
            'grades'=>Grade::all()
        ]);
    }
}
