<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Contracts\Support\Renderable;

class CustomerController extends Controller
{
    public function create(): Renderable
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request): Renderable
    {
        return view('customer.create');
    }
}
