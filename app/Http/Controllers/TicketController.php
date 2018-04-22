<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket as Ticket;

class TicketController extends Controller {
    public function all() {
        return Ticket::all()->toJson();
    }
}
