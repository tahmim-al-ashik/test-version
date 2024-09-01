<?php

namespace App\Http\Controllers\Customer;

use App\Models\Admin\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\Customer\Customer;
use App\Models\Country;
use App\Models\Customer\Language;
use App\Models\Currency;
use App\Models\Customer\Reference;
use App\Models\Customer\DeliveryRequirement;
use App\Models\Customer\PaymentRequirement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $customers = Customer::where('user_id', $userId)->get();

        return Inertia::render('Customers/CustomerList', [
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        $countries = Country::all();
        $languages = Language::all();
        $currencies = Currency::all();
        $currentCustomerNo = Customer::max('customer_no') + 1; // Get the next customer number

        return Inertia::render('Customers/Create', [
            'countries' => $countries,
            'languages' => $languages,
            'currencies' => $currencies,
            'currentCustomerNo' => $currentCustomerNo,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $userId = auth()->id();

        $customers = Customer::with('references')->where('user_id', $userId)
            ->where(function ($q) use ($query) {
                $q->where('customer_name', 'like', "%{$query}%")
                    ->orWhere('email_invoice', 'like', "%{$query}%")
                    ->orWhere('phone_no', 'like', "%{$query}%");
            })
            ->get();

        return response()->json($customers);
    }

    public function store(CustomerRequest $request)
    {

        $maxCustomerNo = Customer::max('customer_no');
        $customerNo = $maxCustomerNo ? $maxCustomerNo + 1 : 1;

        $customer = Customer::create([
            'customer_no' => $customerNo,
            'customer_name' => $request->customer_name,
            'customer_type' => $request->customer_type,
            'personal_id' => $request->personal_id,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'gln' => $request->gln,
            'vat_no' => $request->vat_no,
            'phone_no' => $request->phone_no,
            'mobile_no' => $request->mobile_no,
            'email_invoice' => $request->email_invoice,
            'email_cc' => $request->email_cc,
            'website' => $request->website,
            'country_id' => $request->country_id,
            'language_id' => $request->language_id,
            'currency_id' => $request->currency_id,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->references as $reference) {
            Reference::create([
                'name' => $reference['name'],
                'email' => $reference['email'],
                'phone_no' => $reference['phone_no'],
                'mobile_no' => $reference['mobile_no'],
                'customer_id' => $customer->id,
            ]);
        }

        foreach ($request->delivery_requirements as $requirement) {
            DeliveryRequirement::create([
                'terms_of_delivery' => $requirement['terms_of_delivery'],
                'delivery_method' => $requirement['delivery_method'],
                'customer_id' => $customer->id,
            ]);
        }

        foreach ($request->payment_requirements as $requirement) {
            PaymentRequirement::create([
                'terms_of_payment' => $requirement['terms_of_payment'],
                'currency' => $requirement['currency'],
                'pay_to_account' => $requirement['pay_to_account'],
                'customer_discount' => $requirement['customer_discount'],
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
            ]);
        }

        return redirect()->route('services.show', ['service' => 1])->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::with(['references', 'delivery_requirements', 'payment_requirements'])->findOrFail($id);

        // Ensure the logged-in user is the owner of the customer
        if ($customer->user_id !== auth()->id()) {
            abort(403); // Forbidden
        }

        $countries = Country::all();
        $languages = Language::all();
        $currencies = Currency::all();

        return Inertia::render('Customers/EditCustomer', [
            'customer' => $customer,
            'countries' => $countries,
            'languages' => $languages,
            'currencies' => $currencies,
        ]);
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->user_id !== auth()->id()) {
            abort(403); // Forbidden
        }

        $customer->update($request->all());

        $customer->references()->delete();
        foreach ($request->references as $reference) {
            Reference::create([
                'name' => $reference['name'],
                'email' => $reference['email'],
                'phone_no' => $reference['phone_no'],
                'mobile_no' => $reference['mobile_no'],
                'customer_id' => $customer->id,
            ]);
        }

        $customer->delivery_requirements()->delete();
        foreach ($request->delivery_requirements as $requirement) {
            DeliveryRequirement::create([
                'terms_of_delivery' => $requirement['terms_of_delivery'],
                'delivery_method' => $requirement['delivery_method'],
                'customer_id' => $customer->id,
            ]);
        }

        $customer->payment_requirements()->delete();
        foreach ($request->payment_requirements as $requirement) {
            PaymentRequirement::create([
                'terms_of_payment' => $requirement['terms_of_payment'],
                'currency' => $requirement['currency'],
                'pay_to_account' => $requirement['pay_to_account'],
                'customer_discount' => $requirement['customer_discount'],
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }


    public function getPackagesByService(Request $request)
    {
        $serviceId = $request->query('service_id');
        if (!$serviceId) {
            return response()->json(['error' => 'Service ID is required'], 400);
        }

        $packages = Package::where('service_id', $serviceId)->get();

        return response()->json($packages);
    }
}
