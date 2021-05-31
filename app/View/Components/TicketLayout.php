<?php

namespace App\View\Components;

use App\Models\Ticket;
use Illuminate\View\Component;

class TicketLayout extends Component
{
    public $tickets;
    public $display;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tickets, $display = 5)
    {
        $this->tickets = $tickets;
        $this->display = $display;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ticket-layout');
    }
}
