<?php

namespace App\Livewire\Teacher\Grades;

use Livewire\Component;
use App\Models\Grade;
use Masmerise\Toaster\Toaster;
class EditGrade extends Component
{
    public $grade_details;
    public $name = '';
    public function mount($id){
        $this->grade_details = Grade::find($id);

        $this->fill([
            'name' => $this->grade_details->name,
         
        ]);
       
    }

    public function update(){
        $this->validate([
            'name'=>'required|string|max:255',
        
        ]);

       $grade =  Grade::find($this->grade_details->id)->update([
            'name' => $this->name,
         
        ]);

        Toaster::success('Grade updated successfully!');
        return redirect()->route('grade.index');
    }
    public function render()
    {
        return view('livewire.teacher.grades.edit-grade');
    }
}
