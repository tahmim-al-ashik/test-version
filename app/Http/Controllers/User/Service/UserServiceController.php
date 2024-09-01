<?php
##############user\Service\UserServiceController################
namespace App\Http\Controllers\User\Service;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\CorporateUser;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin\Package;
use App\Http\Requests\User\UserServiceRequest;

class UserServiceController extends Controller
{

    ############showing services from  general user dashboard#############
    public function userIndex()
    {
        $services = Service::select('id', 'name', 'cover_image')->get();
        return Inertia::render('Services/Index', [
            'services' => $services
        ]);
    }


################ service fetching ####################

    public function show(Service $service)
    {
        $user = auth()->user();
        $packages = $service->packages;

        // Check if the user is registered for this service
        $userPackage = $user->services()
            ->where('service_id', $service->id)
            ->withPivot('package_id', 'registration_type')
            ->first();

        $registrationType = null;
        if ($userPackage) {
            $package = Package::find($userPackage->pivot->package_id);
            $userPackage->pivot->package_name = $package->name;

            $registrationType = $userPackage->pivot->registration_type;
        }

        return Inertia::render('Services/Show', [
            'service' => $service,
            'packages' => $packages,
            'userPackage' => $userPackage,
            'registrationType' => $registrationType
        ]);
    }

    public function registerPersonal(Request $request, Service $service)
    {
        $user = auth()->user();

        // Check if the user is already registered for the package
        $existingPackage = $user->packages()
            ->where('user_services.service_id', $service->id)
            ->first();
        if ($existingPackage) {
            return back()->with('error', 'You are already registered for this service.');
        }

        // Get user personal data
        $personalData = $user->only(['name', 'email', 'phone', 'additional_email', 'postal_code', 'zip_code', 'country', 'city']);

        return Inertia::render('Services/RegisterPersonal', [
            'service' => $service->load('packages'), // Ensure packages are loaded
            'personalData' => $personalData,
            'package_id' => $request->query('package_id'), // Pass the package_id to the view
        ]);
    }

    public function registerCorporate(Request $request, Service $service)
    {
        $user = auth()->user();

        // Get corporate data related to user
        $corporateData = CorporateUser::where('user_id', $user->id)->first();

        return Inertia::render('Services/RegisterCorporate', [
            'service' => $service->load('packages'),
            'corporateData' => $corporateData ?? [],
            'package_id' => $request->query('package_id'),
        ]);
    }

    public function storePersonal(UserServiceRequest $request, Service $service)
    {
        $user = auth()->user();
        // Attach the package to the user with the registration type as 'personal'
        $user->packages()->attach($request->package_id, [
            'service_id' => $service->id,
            'registration_type' => 'personal',
            'created_at' => now()
        ]);

        // Check if the package was successfully attached
        if ($user->packages()->wherePivot('service_id', $service->id)->exists()) {
            return redirect()->route('user.registered.services')->with('success', 'You have registered for the service successfully.');
        } else {
            return back()->with('error', 'There was an issue registering the service.');
        }
    }

    public function storeCorporate(UserServiceRequest $request, Service $service)
    {
        $user = auth()->user();

        // Update or create corporate data
        $corporateUser = CorporateUser::updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['name', 'phone', 'postal_code', 'zip_code', 'country', 'city', 'logo'])
        );

        // Attach the package to the user with the registration type as 'corporate'
        $user->packages()->attach($request->package_id, [
            'service_id' => $service->id,
            'registration_type' => 'corporate',
            'created_at' => now()
        ]);

        // Check if the package was successfully attached
        if ($user->packages()->wherePivot('service_id', $service->id)->exists()) {
            return redirect()->route('user.registered.services')->with('success', 'You have registered for the service successfully.');
        } else {
            return back()->with('error', 'There was an issue registering the service.');
        }
    }

    #########show registered package details##########
    public function showPackage(Package $package)
    {
        $package->load('service'); // Load the related service

        return Inertia::render('Services/Invoice', [
            'package' => $package
        ]);
    }



################### registered service details#################
    public function registeredServices()
    {
        $user = auth()->user();
        $registeredServices = $user->services()->with(['packages' => function ($query) use ($user) {
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }])->get();

        return Inertia::render('Services/RegisteredServices', [
            'registeredServices' => $registeredServices
        ]);
    }
    #######################Invoice system  ####################

    public function invoice($serviceId, $packageId)
    {
        $service = Service::findOrFail($serviceId);
        $package = Package::findOrFail($packageId);

        return inertia('Services/Invoice', [
            'service' => $service,
            'package' => $package,
        ]);
    }



###########different redirection for different services#############
    public function showInvoice($serviceId, $packageId)
    {
        $package = Package::with('service')->findOrFail($packageId);

        return Inertia::render('Services/Invoice', [
            'package' => $package
        ]);
    }

    public function showPackageDetails($serviceId, $packageId)
    {
        $package = Package::with('service')->findOrFail($packageId);

        return Inertia::render('Services/PackageDetails', [
            'package' => $package
        ]);
    }
}
