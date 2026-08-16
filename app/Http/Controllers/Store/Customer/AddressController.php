<?php

namespace App\Http\Controllers\Store\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Customer\StoreAddressRequest;
use App\Http\Requests\Store\Customer\UpdateAddressRequest;
use App\Models\Address;
use App\Services\Store\Customer\AddressService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AddressController extends Controller
{
    public function __construct(
        private readonly AddressService $addressService
    ) {
    }

    public function index(): View
    {
        return view('store.customer.addresses.index', [
            'addresses' => $this->addressService->all(),
        ]);
    }

    public function create(): View
    {
        return view('store.customer.addresses.create');
    }

    public function store(
        StoreAddressRequest $request
    ): RedirectResponse {
        $this->addressService->store(
            $request->validated()
        );

        return redirect()
            ->route('store.customer.addresses.index')
            ->with(
                'success',
                'Endereço cadastrado com sucesso.'
            );
    }

    public function edit(
        Address $address
    ): View {
        $this->addressService->ensureOwnership($address);

        return view('store.customer.addresses.edit', [
            'address' => $address,
        ]);
    }

    public function update(
        UpdateAddressRequest $request,
        Address $address
    ): RedirectResponse {
        $this->addressService->update(
            $address,
            $request->validated()
        );

        return redirect()
            ->route('store.customer.addresses.index')
            ->with(
                'success',
                'Endereço atualizado com sucesso.'
            );
    }

    public function destroy(
        Address $address
    ): RedirectResponse {
        $this->addressService->destroy($address);

        return back()->with(
            'success',
            'Endereço removido com sucesso.'
        );
    }

    public function makeDefault(
        Address $address
    ): RedirectResponse {
        $this->addressService->makeDefault($address);

        return back()->with(
            'success',
            'Endereço principal atualizado.'
        );
    }
}
