<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Services\WebhookApiService;
use Illuminate\Contracts\Support\Renderable;

class CustomerController extends Controller
{
    public function create(): Renderable
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request): Renderable
    {
        $data = $request->validated();
        $data['marketing_consent'] = $request->boolean('marketing_consent');

        $service = new WebhookApiService;
        $response = $service->post($data);

        return view('customer.result', $data);
    }
}
