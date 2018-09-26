<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use App\Address;
use App\Job;
use DB;
use Session;

class DeletedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAccounts()
    {
        $deletedUsers = User::onlyTrashed()->get();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.deleted.accounts')->withDeletedUsers($deletedUsers)->withRoles($roles)->withPermissions($permissions);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->where('id', $id);
        $address = Address::withTrashed()->where('user_id', $id);
        $user->restore();
        $address->restore();

        Session::flash('success', 'The Account has been Successfuly restored!');
        return redirect()->route('users.index');
    }

    public function delete(Request $request, $id)
    {
      $user = User::withTrashed()->where('id', $id)->with('roles')->with('permissions')->first();
      $address = Address::withTrashed()->where('user_id', $id);
      $user->forceDelete();
      if ($user->forceDelete()){
        $address->forceDelete();
        $user->detachRole($request->roles);
        $user->detachPermission($request->permissions);
      }

      Session::flash('success', 'The Account has been deleted permanently!');
      return redirect()->route('users.index');
    }

    public function getJobs()
    {
      $deletedJobs = Job::onlyTrashed()->get();
      return view('dashboard.deleted.jobs')->withDeletedJobs($deletedJobs);
    }

    public function restoreJob($id)
    {
        $job = Job::withTrashed()->where('id', $id);
        $job->restore();

        Session::flash('success', 'The Job has been Successfuly restored!');
        return redirect()->route('jobs.index');
    }

    public function deleteJob(Request $request, $id)
    {
      $job = Job::withTrashed()->where('id', $id);
      $job->forceDelete();

      Session::flash('success', 'The Job has been deleted permanently!');
      return redirect()->route('jobs.index');
    }
}
