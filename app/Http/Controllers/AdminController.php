<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController
{
    public function render(){
        return view('admin.dashboard');
    }
}
