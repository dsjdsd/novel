<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class RegistrationController extends Controller
{
    public function registration(){
        return view('register');
    }
    public function registrationPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255|unique:users,mobile_number',
            'email' => 'required|string|email|max:255|unique:users,email',
        ]);
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile_number = $request->mobile_number;
        $users->password = Hash::make($request->mobile_number);
        $users->normal_password = $request->mobile_number;
        $users->save();
        return redirect()->route('login')->with('success', 'Your users details have been saevd successfully.');   
    }
    public function login(){
        return view('login');
    }
    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role==2 && Auth::user()->status==1){
                return redirect("user-dashboard");
            }
            Auth::logout();
            return redirect()->back()->with('error', 'Your status is In-Active.');        }
        return redirect()->back()->with('error','Your login details is invalid.');
        
    }
}
