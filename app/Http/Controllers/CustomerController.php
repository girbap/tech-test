<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class CustomerController extends Controller
{
    public function create(): Renderable
    {
        return view('customer.create');
    }
}
