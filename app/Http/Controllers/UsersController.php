<?php

namespace App\Http\Controllers;
use App\Location;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUpdateProfile() {
        return view('users.updateProfile');
        
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
        
        $location->user_id = $user->id ;
        $location->name = $request->get('name');
        $location->latitude = $request->get('lat');
        $location->longitude = $request->get('lng');
        $location->ip = $request->ip();
        
        $user->locations()->save($location);
        return redirect('updateProfile');
    }

}
