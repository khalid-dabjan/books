<?php

namespace App\Http\Controllers;

use App\User;
use App\Auther;
use App\Book;
use App\Location;
use Illuminate\Http\Request;
use App\Notifications\BookMatch;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getUpdateProfile() {
        $user = auth()->user();
        $locations = $user->locations;
        return view('users.updateProfile', compact('locations', 'user'));
    }

    public function getAddresses() {
        return view('users.addresses');
    }

    public function saveGeoLocation(Request $request) {
        $location = new Location;
        $user = auth()->user();

        validator($request->all(), [
            'name' => 'required|max:30',
        ])->validate();

        $location->user_id = $user->id;
        $location->name = $request->get('name');
        $location->latitude = $request->get('lat');
        $location->longitude = $request->get('lng');
        $location->ip = $request->ip();

        $user->locations()->save($location);
        return redirect('updateProfile');
    }

    public function getAddressesList() {
        $locations = auth()->user()->locations;

        return view('users.addressesList', compact('locations'));
    }

    public function getAddressesEdit(Location $location) {
        $user = auth()->user();
        if ($user->id !== $location->user_id) {
            abort(403, 'Unautherized action.');
        }
        return view('users.addressesEdit', compact('location'));
    }

    public function updateGeoLocation(Request $request, Location $location) {
        $user = auth()->user();

        if ($user->id !== $location->user_id) {
            abort(403, 'Unautherized action.');
        }

        validator($request->all(), [
            'name' => 'required|max:30',
        ])->validate();

        $location->name = $request->get('name');
        $location->latitude = $request->get('lat');
        $location->longitude = $request->get('lng');
        $location->ip = $request->ip();

        $location->save();
        return redirect('/updateProfile');
    }

    public function deleteGeoLocation(Location $location) {
        $location->delete();
        return redirect('updateProfile');
    }

    public function getUsersList() {
        $users = User::get();
        $authers = Auther::get();
        return view('users.usersList', compact('users', 'authers'));
    }

    public function getUserProfile(User $user) {
        $books = $user->books;
        return view('users.userProfile', compact('user', 'books'));
    }

    public function theFollowing(Request $request, User $user) {
        $followerId = auth()->user()->id;


        if ($followerId == $user->id) {
            abort(403, ' Unautherized Action.');
        }
        if ($user->user_is_following_user) {
            $user->followers()->detach($followerId);
        } else {
            $user->followers()->attach($followerId, ['type' => 'user']);
        }
        return redirect('/home');
    }

}
