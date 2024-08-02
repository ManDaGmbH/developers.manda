<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use Spatie\Permission\Models\Role;
use App\Models\ModelHasRole;

class UsersController extends Controller {

    function __construct() {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $roles = Role::all();
        $field = 'id';
        $order = 'DESC';
        if (!empty($request->sort_field) && !empty($request->sort_order)) {
            $field = $request->sort_field;
            $order = $request->sort_order;
        }
//        dd($request->sort_order);

        $user = User::with('ModelHasRoles')->orderBy($field, $order);
        if ($request->first_name) {
            $user = $user->where('first_name', 'like', '%' . $request->first_name . '%');
        }
        if ($request->last_name) {
            $user = $user->where('last_name', 'like', '%' . $request->last_name . '%');
        }
        if ($request->email) {
            $user = $user->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->role) {
            $roleId = $request->role;
            $user = $user->whereHas('ModelHasRoles', function ($query) use($roleId) {
                $query->where('role_id', '=', $roleId);
            });
        }
        $records = 10;
        if ($request->status != null) {
            $user = $user->where('status', $request->status);
        }
        $user = $user->paginate($records);
        if ($request->ajax()) {
            $pageNo = $request->input('page', 1);
            if ($request->is_fresh_data == 1) {
                $pageNo = 1;
            }
            $view = view('admin.users.partials.loop.list', ['users' => $user, 'roles' => $roles])->with('i', ($pageNo - 1) * $records)->render();
            return response()->json(['html' => $view]);
        }
        return view('admin.users.list', ['users' => $user, 'roles' => $roles])->with('i', ($request->input('page', 1) - 1) * $records);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //
        $request->merge(['status' => 1]);
        $request->merge(['password' => 'cyberclouds@6']);
        
        $valdidateData = $request->validate([
            'first_name' => 'required | min:3',
            'last_name' => 'required | min:3',
            'email' => 'required | email | confirmed | unique:users',
            'email_confirmation' => 'required',
            'password' => 'required | min:8',
            //'password_confirmation' => 'required',
            'roles' => 'required',
            'status' => 'required',
            'phone1'=>'',
            'phone2'=>'',
            'address1'=>'',
            'address2'=>'',
            'city'=>'',
            'state'=>'',
            'zip'=>''
        ]);

        $user = User::create($valdidateData);
        $user->assignRole($request->input('roles'));
        if ($user) {
            $reset_token = base64_encode(rand() . time());
            $reset_expiry = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $data_update = ['reset_token' => $reset_token, 'reset_token_expiry' => $reset_expiry];

            $user_update = User::where(['id' => $user->id])->update($data_update);


            $reset_url = url('/backend') . "/resetPassword/" . $reset_token;
            $html = '<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="'.url('/').'" title="logo" target="_blank">
                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <a href="'.$reset_url.'"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.'. strtolower(config('app.name')).'.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';
            //$html = "Hi " . $user->first_name." ". $user->last_name . ", <br /><br /> Below is your password reset link. Please click it to set your Password.<br><br><a href='$reset_url'>$reset_url</a><br /><br />Thanks<br />" . env('COMPANY_NAME');
            Mail::send(array(), array(), function ($message) use ($html, $user) {
                $message->to($user->email)
                    ->subject(config('app.name') . " Account Password Reset")
                    ->setBody($html, 'text/html');
            });
            return redirect()->route('admin.users.index')->with('success', 'User created');
        } else {
            return redirect()->route('admin.users.create')->with('error', 'User not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        return view('admin.users.edit', [
            'user' => User::find($id),
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot edit this user');
        }
        $valdidateData = $request->validate([
            'first_name' => 'required | min:3',
            'last_name' => 'required | min:3',
            'email' => 'required | email | confirmed | unique:users,email,' . $id,
            'email_confirmation' => 'required',
            'roles' => 'required',
            'status' => 'required',
            'phone1'=>'',
            'phone2'=>'',
            'address1'=>'',
            'address2'=>'',
            'city'=>'',
            'state'=>'',
            'zip'=>''
        ]);

        $user->update($valdidateData);

        $u = ModelHasRole::where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'User Updated');
        } else {
            return redirect()->route('admin.users.edit')->with('error', 'User not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $find = User::find($id)->getRoleNames();
        if ($find[0] == 'Admin') {
            $count = User::join('model_has_roles as mhr', 'mhr.model_id', 'users.id')->where('role_id', 1)->count();
//            dd($count);
            if ($count == 1) {
                return redirect()->route('admin.users.index')->with('error', 'Last Admin Can not be deleted.');
            }
        }
//        exit;
        if ($id != Auth::user()->id) {
            User::destroy($id);
            return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully');
        } else {
            return redirect()->route('admin.users.index')->with('error', 'You are not allowed to delete that user');
        }
    }

    public function login(Request $request) {
        if ($request->method() == 'POST') {
            $email = $request->email;
            $password = $request->password;
            $request->validate([
                'green_box' => 'required | in:' . config('app.name'),
            ]);
            if ($auth = Auth::attempt(['email' => $email, 'password' => $password])) {
                if ($auth) {
                    $currentUser = Auth::user();
                    if (($currentUser->status == 0)) {
                        Auth::logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();
                        return redirect()->back()->with('error', 'Your Account Is Not Active');
                    } else if (($currentUser->reset_token != '')) {
                        Auth::logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();
                        return redirect('backend/forgotPassword')->with('error', 'Please Reset Your Password');
                    }
                }
                $request->session()->regenerate();

                return redirect()->intended('backend/dashboard')->with('success', 'Logged In Successfully');
            }
            return redirect()->back()->with('error', 'Invalid Login Details');
        }
        return view('admin.users.login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/backend')->with('success', 'Logged Out Successfully');
    }

    public function recoverPassword(Request $request) {
        if ($request->method() == "POST") {
            // Firt check if email exist in DB
            $request->validate([
                'email' => 'required'
            ]);
            $user = User::where(['email' => $request->email])->first();

            if ($user) {
                // Logic to create reset token, expiry datetime, send in email the reset link
                $reset_token = base64_encode(rand() . time());
                $reset_expiry = date('Y-m-d H:i:s', strtotime('+1 hours'));
                $data_update = ['reset_token' => $reset_token, 'reset_token_expiry' => $reset_expiry];

                $user_update = User::where(['id' => $user->id])->update($data_update);


                $reset_url = url('/backend') . "/resetPassword/" . $reset_token;
                // Send Email
                
                $html = '<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="'.url('/').'" title="logo" target="_blank">
                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <a href="'.$reset_url.'"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.'. strtolower(config('app.name')).'.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';
                
                //$html = "Hi " . $user->first_name." ". $user->last_name .  ", <br /><br /> Below is your password reset link. Please click it to recover your password.<br><br><a href='$reset_url'>$reset_url</a><br /><br />Thanks<br />" . env('COMPANY_NAME');
    
                Mail::send(array(), array(), function ($message) use ($html, $user) {
                    $message->to($user->email)
                            ->subject(config('app.name') . " Account Password Reset")
                            ->setBody($html, 'text/html');
                });

                return back()->with('success', 'If the information entered is associated with an account we have sent you an email with password reset instructions');
            } else {
                return back()->with('success', 'If the information entered is associated with an account we have sent you an email with password reset instructions');
            }
        }
        return view('admin.users.forgotpassword');
    }
     public function resetpasswordmanually($email) {
        if ($email) {
            // Firt check if email exist in DB
            
            $user = User::where(['email' => $email])->first();

            if ($user) {
                // Logic to create reset token, expiry datetime, send in email the reset link
                $reset_token = base64_encode(rand() . time());
                $reset_expiry = date('Y-m-d H:i:s', strtotime('+1 hours'));
                $data_update = ['reset_token' => $reset_token, 'reset_token_expiry' => $reset_expiry];

                $user_update = User::where(['id' => $user->id])->update($data_update);


                $reset_url = url('/backend') . "/resetPassword/" . $reset_token;
                // Send Email

                $html = '<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: Open Sans, sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a href="'.url('/').'" title="logo" target="_blank">
                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <a href="'.$reset_url.'"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.'. strtolower(config('app.name')).'.com</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';
                //$html = "Hi " . $user->first_name." ". $user->last_name . ", <br /><br /> Below is your password reset link. Please click it to reset your password.<br><br><a href='$reset_url'>$reset_url</a><br /><br />Thanks<br />" . env('COMPANY_NAME');
                
                Mail::send(array(), array(), function ($message) use ($html, $user) {
                    $message->to($user->email)
                            ->subject(config('app.name') . " Account Password Reset")
                            ->setBody($html, 'text/html');
                });

                return back()->with('success', 'Password reset link send to the email address.');
            } else {
                return back()->with('success', 'Password reset link send to the email address.');
            }
        }
        return view('admin.users.edit', [
            'user' => User::find($user->id),
            'roles' => Role::all()
        ]);
    }

    public function resetPassword($token) {
        if ($token) {
            // check token valid and if expired
            $user = User::where(['reset_token' => $token])->first();

            if ($user && date('Y-m-d H:i:s', strtotime($user->reset_token_expiry)) > date('Y-m-d H:i:s', time())) {
                return view('admin/users/resetpassword', ['token' => $token]);
            } else {
                return redirect('backend/forgotPassword')->with('error', 'Your reset link got expired or in-valid. Try Again');
            }
        } else {
            return redirect('backend/forgotPassword');
        }
    }

    public function changePassword(Request $request) {
        if ($request->method() == "POST") {

            if (isset($request->changepassword)) {
                $request->validate([
                    'currentpassword' => 'required',
                    'password' => 'required|between:8,255|confirmed',
                    'password_confirmation' => 'required'
                ]);
                if (Hash::check($request->currentpassword, Auth::user()->password)) {
                    $update_pass = User::find(Auth::user()->id)->update($request->only('password'));
                    if ($update_pass) {
                        return redirect('/backend/dashboard')->with('success', 'Password Updated Successfully');
                    } else {
                        return back()->with('error', 'Some Error Occured, Please Try Again');
                    }
                } else {
                    return back()->with('error', 'Current password is invalid');
                }
            } elseif (isset($request->reset_token)) {
                $user = User::where(['reset_token' => $request->reset_token])->first();
                if ($user && date('Y-m-d H:i:s', strtotime($user->reset_token_expiry)) > date('Y-m-d H:i:s', time())) {
                    $request->validate([
                        'password' => 'required|between:8,255|confirmed',
                        'password_confirmation' => 'required'
                    ]);
                    $request->merge(['reset_token' => Null, 'reset_token_expiry' => Null]);
                    $update_pass = User::find($user->id)->update($request->only('reset_token', 'reset_token_expiry', 'password'));
                    if ($update_pass) {
                        return redirect('/backend/login')->with('success', 'Password Updated Successfully');
                    } else {
                        return back()->with('error', 'Some Error Occured, Please Try Again');
                    }
                } else {
                    User::where(['reset_token' => $token])->update(['id' => $user->id]);
                    return redirect('/backend/forgotPassword')->with('error', 'Your reset link got expired or in-valid. Try Again');
                }
            }
        }
        return view('admin.users.changepassword');
    }

    public function profileEdit() {
        return view('admin/users/profile', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request) {
        //
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return redirect('/backend/dashboard')->with('error', 'You cannot edit this user');
        }
        $request->merge(['status' => 1]);
        $valdidateData = $request->validate([
            'first_name' => 'required | min:3',
            'last_name' => 'required | min:3',
            'email' => 'required | email | unique:users,email,' . Auth::user()->id,
            'status' => 'required'
        ]);

        $user->update($valdidateData);

        if ($user) {
            return redirect('/backend/dashboard')->with('success', 'Profile Updated');
        } else {
            return redirect('/backend/dashboard')->with('error', 'Profile not Updated');
        }
    }

}
