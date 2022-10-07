<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Country;
use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassword;

class UserController extends Controller
{
    use CrudTrait;
    public function index()
    {
        if (auth()->user()->type == 'super_admin') {
            return view('admin.users.index');
        } else {
            return abort('403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all()->pluck('name', 'id');
        if (auth()->user()->type == 'super_admin') {
            return view('admin.users.insert', compact('country'));
        } else {
            return abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (auth()->user()->type == 'super_admin') {
            $data = $request->only('name', 'phone', 'email', 'type', 'image', 'password', 'password_confirmation');
            $data['password'] = Hash::make($request->password);
            if ($request->type == 'admin') {
                $data['verify_phone'] = 1;
                $data['is_active'] = 1;
            }
            if ($request->hasFile('image')) {
                if ($request->type == 'admin') {
                    $data['verify_phone'] = 1;
                    $data['is_active'] = 1;
                    $image_path = FileHelper::upload_file('admins', $request->image);
                } else {
                    $image_path = FileHelper::upload_file('companies', $request->image);
                }
                $data['image'] = $image_path;
            }
            $this->storeTrait(new User, $data);
            session()->flash('success', trans('admin.user-add-message'));
            return redirect()->route('users.index');
        } else {
            return abort('403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->type == 'super_admin') {
            $country = Country::all()->pluck('name', 'id');
            $data = $this->showTrait(new User, $user->id);
            return view('admin.users.edit', compact('data', 'country'));
        } else {
            return abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (auth()->user()->type == 'super_admin') {
            $data = $request->only('name', 'phone', 'type', 'image', 'password', 'password_confirmation');
            $user = USer::where('id', $user->id)->first();
            if ($request->hasFile('image')) {
                if ($request->type == 'admin') {
                    $image_path = FileHelper::update_file('admins', $request->image, $user->image);
                } else {
                    $image_path = FileHelper::update_file('companies', $request->image, $user->image);
                }
                $data['image'] = $image_path;
            }
            $this->updateTrait(new User, $user->id, $data);
            session()->flash('success', trans('admin.user-edit-message'));
            return redirect()->route('users.index');
        } else {
            return abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->type == 'super_admin') {
            $user = User::where('id', $id)->first();
            if ($user->image != null) {
                FileHelper::delete_picture($user->image);
            }
            $this->destroyTrait(new User, $id);
            session()->flash('success', trans('admin.user-delete-message'));
            return redirect()->route('users.index');
        } else {
            return abort('403');
        }
    }

    public function showUserProfile()
    {
        return view('admin.users.profile');
    }

    public function updateUserProfile(UserRequest $request)
    {
        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name ?? $user->name;
        $user->phone = $request->phone ?? $user->phone;
        if ($request->has('image')) {
            $image = FileHelper::upload_file('user/profile', $request->image);
            $user->image = $image;
        }
        $user->save();
        session()->flash('success', trans('admin.user-edit-profile'));
        return redirect()->back();
    }

    public function updatePasswordView()
    {
        return view('admin.users.password');
    }

    public function updatePassword(updatePassword $request)
    {
        $user = User::where('id', Auth::id())->first();
        if (Hash::check($request->old_password, $user->password)) {
            User::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
            session()->flash('success', trans('admin.update_password_message'));
        } else {
            session()->flash('failed', trans('admin.old_password_wrong'));
        }
        return redirect()->back();
    }

    public function forgetPasswordView()
    {
        return view('auth.passwords.phone');
    }
}
