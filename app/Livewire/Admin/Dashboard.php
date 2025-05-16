<?php

namespace App\Livewire\Admin;


use Livewire\{Component,WithPagination};

class Dashboard extends Component
{
    public function render(){
        return view('admin.dashboard');
    }
}