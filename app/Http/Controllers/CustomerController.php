<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Services\WebhookApiService;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function create(): Renderable
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request): Renderable | RedirectResponse
    {
        $data = $request->validated();
        $data['marketing_consent'] = $request->boolean('marketing_consent');

        try {

            $service = new WebhookApiService;
            $response = $service->post($data);

            if ($response->successful()) {
                return view('customer.result', $data);
            }

        } catch (Exception $e) {
            //
        }

        return redirect()->back()->withErrors([
            'submission' => 'It was not possible to submit your details. Please try again.',
        ])->withInput();
    }
}
