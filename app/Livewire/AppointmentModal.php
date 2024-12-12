<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AppointmentModal extends Component
{
    public $openModal = false; // Track if modal is open or not

    // Method to open the modal
    public function showModal()
    {
        $this->openModal = true;
    }

    // Method to close the modal
    public function closeModal()
    {
        $this->openModal = false;
    }

    public function render()
    {
        return view('livewire.appointment-modal');
    }
}
