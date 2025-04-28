<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;

class GradeList extends Component
{
    public function render()
    {
        return view('livewire.teacher.grades.grade-list',[
            'grades'=>Grade::all()
        ]);
    }
}
