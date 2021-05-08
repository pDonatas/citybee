<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Discount;
use App\Models\RentSession;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController
{
    public function showCarControls(int $id): View
    {
        $car = RentSession::find($id)->car()->first();

        return view('specialists.controls', compact('car'));
    }

    public function updateCarData(Request $request): JsonResponse
    {
        $car = Car::find($request->get('id'));

        $car->update([
            'status' => $request->get('status')
        ]);

        return response()->json(['success' => 'Technical service is on it\'s way to car']);
    }

    public function lockCar(int $id): RedirectResponse
    {
        $car = Car::find($id);
        if (!$car) {
            return redirect()->back()->with('error', 'Car not found');
        }

        switch($car->locked) {
            case 1:
                $car->update([
                    'locked' => false
                ]);
                return redirect()->back()->with('success', 'Car has been unlocked');
            case 0:
                $car->update([
                    'locked' => true
                ]);
                return redirect()->back()->with('success', 'Car has been locked');
        }

        return redirect()->back()->with('error', 'Unexpected error happened');
    }

    public function showDiscounts(int $id)
    {
        $discounts = Discount::where('active', true)->get();

        return view('specialists.discounts', compact(['discounts', 'id']));
    }

    public function submitDiscount(Request $request, int $id): RedirectResponse
    {
        if ($request->get('discount') == 0) {
            return redirect()->back()->with('error', 'Can not apply 0% discount');
        }

        $user = User::find($id);
        $discount = Discount::find($request->get('discount'));
        $user->discounts()->attach($discount);
        $message = $discount->percents.' % discount applied successfully';

        return redirect()->back()->with('success', $message);
    }

    public function banUser(Request $request): JsonResponse
    {
        $user = User::find($request->get('id'));

        switch($user->is_suspended) {
            case 1:
                $user->update([
                    'is_suspended' => 0
                ]);

                return response()->json(['success' => 'User has been unbanned successfully']);
            case 0:
                $user->update([
                    'is_suspended' => 1
                ]);

                return response()->json(['success' => 'User has been banned successfully']);
        }

        return response()->json(['success' => 'Something went wrong']);
    }
}
