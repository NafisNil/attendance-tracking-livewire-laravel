<?php

namespace App\Livewire\Teacher\Grades;

use Livewire\Component;
use App\Models\Grade;
use Masmerise\Toaster\Toaster;
class AddGrade extends Component
{
    public $name = '';
    public function save(){
        $this->validate([
            'name'=>'required|string|max:255',
        
        ]);

       $grade =  Grade::create([
            'name' => $this->name,
        
        ]);

        Toaster::success('Grade created successfully!');
        return redirect()->route('grade.index');
    }
    public function render()
    {
        return view('livewire.teacher.grades.add-grade');
    }
}
