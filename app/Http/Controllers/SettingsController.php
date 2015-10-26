<?php

namespace App\Http\Controllers;

use Hash;
use Log;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Custom\OAuth2\Client\Provider\Stripe;
use App\Custom\OAuth2\Client\Provider\StripeAccessToken;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class SettingsController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a authenticated user's settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $user = $request->user();
        return view('settings')->with('user', $user);
    }

    /**
     * Update the authenticated user's information.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($data = $request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|min:10|max:20',
            'password' => 'required',
            'new_password' => 'confirmed|min:6',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('failure', 'Oops! There were errors processing your form. Please fix the errors below and try again.');
            return redirect('/settings')->withErrors($validator)->withInput();
        } else if (!Hash::check($data['password'], $user->password)) {
            return redirect('/settings')->with('failure', 'The password you specified is not correct, please try again.')->withInput();
        }

        // Validation ok and password matched.

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if (!empty($data['new_password'])) {
            $user->password = bcrypt($data['new_password']);
        }

        $user->save();

        return redirect('/settings')->with('success', 'Your information was updated successfully.');
    }
}
