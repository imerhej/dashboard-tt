<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RoleUser;
use App\State;
use App\Address;
use Session;
use Auth;
use Hash;
use DB;


class MyProfileController extends Controller
{

      public function __construct() {

          $this->middleware('auth');
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         return view('dashboard.myprofile.index', array('user' => Auth::user()));
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $loggedId = Auth::id();
        // dd($loggedId);
        $user = User::findOrFail($loggedId);
        $roles = Role::all();
        $states = State::pluck('state', 'state');
        $userAddress = $user->address;
        // dd($userAddress);
        return view('dashboard.myprofile.edit', array('user' => Auth::user()), compact('user','roles', 'states', 'userAddress'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
       $this->validate($request, [
         'first_name' => 'required|max:255',
         'last_name' => 'required|max:255',
         'email' => 'required|email|unique:users,email,'.$id
       ]);

       $user = User::findOrFail($id);
       $user->first_name = $request->first_name;
       $user->last_name = $request->last_name;
       $user->email = $request->email;
       if ($request->password_options == 'auto') {
           $password = $request->auto_password;
           $user->password = Hash::make($password);
       } elseif ($request->password_options == 'manual') {
           $this->validate($request, [
             'password' => 'required|min:5|confirmed',
             'password_confirmation' => 'required|min:5'
           ]);
           $user->password = Hash::make($request->password);
       }
       $user->save();

       if ($user->save()) {
         $user_id = $user->id;
         $data = [
                 'phone_number' => $request->phone_number,
                 'address1' => $request->address1,
                 'address2' => $request->address2,
                 'city' => $request->city,
                 'state' => $request->state,
                 'zipcode' => $request->zipcode];

         $address = Address::where('user_id', $user_id)->update($data);

       }

       Session::flash('success', 'Your Profile has been updated Successfuly!');
       return redirect()->route('myprofile.index');

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
