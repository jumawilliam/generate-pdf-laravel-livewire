<?php

namespace App\Livewire;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\User;
class Users extends Component
{

    public $users;

    public function mount(){
        $this->users=User::all();
    }
    public function render()
    {
        return view('livewire.users');
    }

    public function generatePdf(){

        $data=[
            'users'=>$this->users
        ];

        $pdf=Pdf::loadView('users-pdf',$data);

        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        },'users.pdf');
    }
}
