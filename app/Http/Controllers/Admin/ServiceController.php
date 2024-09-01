<?php
##########Http->controllers->Admin->ServiceController.php###############
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Service;
use App\Models\Admin\Package;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
//use Intervention\Image\Image;
//use Image;



class ServiceController extends Controller
{
    #################index function added to show services and packages #############
    public function index()
    {
        $services = Service::with('packages')
            ->withCount('users') // Fetch the count of registered users
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    ###############create function added to enter Service create route ##############
    public function create()
    {
        return view('admin.services.create');
    }

    #################store function added to post Service and packages to database #############
    public function store(ServiceRequest $request)
    {
        // Handle the cover image upload
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $this->processImage($request->file('cover_image'), 'services');
        }

        // Create a new Service
        $service = new Service();
        $service->name = $request->serviceName;
        $service->description = $request->serviceDescription;
        $service->cover_image = $coverImagePath ?? null;
        $service->save();

        // Handle the packages
        if ($request->has('packages')) {
            foreach ($request->packages as $packageData) {
                $package = new Package();

                // Handle the package image upload
                if (isset($packageData['image']) && $packageData['image']) {
                    $packageImagePath = $this->processImage($packageData['image'], 'packages');
                    $package->image = $packageImagePath;
                }

                $package->name = $packageData['name'] ?? null;
                $package->description = is_array($packageData['description']) ? implode(', ', $packageData['description']) : $packageData['description'] ?? null;
                $package->price = $packageData['price'] ?? null;
                $package->discount = $packageData['discount'] ?? null;
                $service->packages()->save($package);
            }
        }

        return redirect()->route('admin.services.create')->with('success', 'Service created successfully.');
    }

    #################Edit function handle the edit route of services and packages #############
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->name = $request->serviceName;
        $service->description = $request->serviceDescription;

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $this->processImage($request->file('cover_image'), 'cover_images');
            $service->cover_image = $coverImagePath;
        }

        $service->save();

        // Delete existing packages
        $service->packages()->delete();

        // Add updated packages
        if ($request->has('packages')) {
            foreach ($request->packages as $packageData) {
                if (!empty($packageData['name']) || !empty($packageData['price']) || !empty($packageData['discount']) || !empty($packageData['description']) || !empty($packageData['image'])) {
                    // Convert description array to string if it's an array
                    $description = is_array($packageData['description']) ? implode(', ', $packageData['description']) : $packageData['description'];

                    $package = new Package([
                        'name' => $packageData['name'] ?? null,
                        'description' => $description ?? null,
                        'price' => $packageData['price'] ?? null,
                        'discount' => $packageData['discount'] ?? null,
                    ]);

                    // Handle package image upload
                    if (isset($packageData['image']) && $packageData['image']) {
                        $packageImagePath = $this->processImage($packageData['image'], 'packages');
                        $package->image = $packageImagePath;
                    }

                    $service->packages()->save($package);
                }
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    #################Delete is use to delete packages #############
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    ################# Process Image Method #############
    private function processImage($image, $folder)
    {
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = storage_path('app/public/' . $folder . '/' . $filename);

        $image = Image::make($image->getRealPath());
        $image->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        return $folder . '/' . $filename;
    }
}

##########Http->controllers->Admin->ServiceController.php###############
