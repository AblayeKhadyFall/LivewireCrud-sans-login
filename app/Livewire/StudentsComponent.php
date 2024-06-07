<?php

namespace App\Livewire;

use App\Models\Etudients;
use Livewire\Component;

class StudentsComponent extends Component

{

    public $etudient_id,$name,$email,$phone,$etudient_edit_id,$etudient_delete_id;
    public $view_etudient_id,$view_etudient_name,$view_etudient_email,$view_etudient_phone;

    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'etudient_id' => 'required|unique:etudients,etudient_id,' . $this->etudient_edit_id,            //vlidation with ignoring own data
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',

        ]);
    }
    public function storeStudentData(){

        //on form submit validation

        $this->validate([
            'etudient_id'=>'required|unique:etudients', //students table name
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);
        //Add student data
        $etudient = new Etudients();
        $etudient->etudient_id = $this->etudient_id;
        $etudient->name = $this->name;
        $etudient->email = $this->email;
        $etudient->phone = $this->phone;

        $etudient->save();
        session()->flash('message','New Student has been added successfully');
        $this->resetInputs();

        $this->etudient_id= '';
        $this->name= '';
        $this->email= '';
        $this->phone= '';

        //For hide model after and student success

        $this->dispatch('close-modal');
        // $this->emitTo('refreshComponent');
    }
    public function resetInputs(){

        $this->etudient_id= '';
        $this->name= '';
        $this->email= '';
        $this->phone= '';
        $this->etudient_edit_id='';
    }

    public function editStudents($id){
        $etudient = Etudients::where('id',$id)->first();
        $this->etudient_edit_id = $etudient->id;
        $this->etudient_id = $etudient->etudient_id;
        $this->name = $etudient->name;
        $this->email = $etudient->email;
        $this->phone = $etudient->phone;
        $this->dispatch('show-edit-etudient-modal');

    }
    public function editStudentData(){
              //on form submit validation

              $this->validate([
                'etudient_id' => 'required|unique:etudients,etudient_id,' . $this->etudient_edit_id,                //vlidation with ignoring own data
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required|numeric',
            ]);
            $etudient = Etudients::where('id',$this->etudient_edit_id)->first();     
            $etudient->etudient_id = $this->etudient_id;
            $etudient->name = $this->name;
            $etudient->email = $this->email;
            $etudient->phone = $this->phone;

            $etudient->save();
            session()->flash('message','This Student has been updated successfully');
            $this->dispatch('close-modal');

    }
    // Delete Confirmation
    public function deleteConfirmation($id){

        //$etudient = Etudients::where('id',$id)->first();
        $this->etudient_delete_id = $id; //Student id
        $this->dispatch('show-delete-confirmation-modal');
    }
    public function deleteStudentData(){
        $etudient = Etudients::where('id',$this->etudient_delete_id)->first();
        $etudient->delete();
        session()->flash('message','Student has been delete successfully');
        $this->dispatch('close-modal');
        $this->etudient_delete_id = '';
    }
    public function cancel(){
        $this->etudient_delete_id = '';
    }
    public function viewStudentsDetails($id){
        $etudient = Etudients::where('id',$id)->first();
        $this->view_etudient_id = $etudient->id;
        $this->view_etudient_name = $etudient->etudient_id;
        $this->view_etudient_email = $etudient->name;
        $this->view_etudient_phone = $etudient->email;

        $this->dispatch('show-view-etudient-modal');

    }
    public function closeViewStudentsModal(){

        $this->view_etudient_id = '';
        $this->view_etudient_name = '';
        $this->view_etudient_email = '';
        $this->view_etudient_phone = '';
    }
    public function render()
    {
        $etudients = Etudients::all();
        return view('livewire.students-component',['etudients'=>$etudients])->layout('livewire.layouts.base');
    }
}
