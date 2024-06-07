<?php

use App\Livewire\StudentsComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});


Route::get('students',StudentsComponent::class);
