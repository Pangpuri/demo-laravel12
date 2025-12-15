<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //registerfunction
    public function showRegister()
    {
        return view('auth.register');
    }

    //submit register function can be added here
    public function register(Request $request)
    {
        // Registration logic goes here
        //validation
        $request->validate([
            'name' => 'required|string|max:64',
            'email' => 'required|string|email|max:64|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:200',
            'password' => 'required|string|min:8|confirmed',
            
        ]
        //custom error messages
        ,[
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name cannot exceed 64 characters',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email cannot exceed 64 characters',
            'email.unique' => 'Email already exists',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone number is required',
            'address.required' => 'Address is required',
            'address.max' => 'Address cannot exceed 200 characters',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password cannot exceed 24 characters',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
        ]); 

        //create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'email_verified_at' => now(),
        ]);
        //bcrypt: ฟังก์ชันที่ใช้ในการเข้ารหัสรหัสผ่านให้ปลอดภัยก่อนเก็บลงฐานข้อมูล
        // ใช้เพื่อป้องกันไม่ให้รหัสผ่านถูกเก็บในรูปแบบข้อความธรรมดา

        //return redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    //login page
    public function showLogin()
    {       
        return view('auth.login');
    }

    // login function 
    public function login(Request $request)
    {
        // Login logic 
        //validation
        //$credentials คือข้อมูลที่ผู้ใช้กรอกมาเพื่อตรวจสอบสิทธิ์การเข้าสู่ระบบ
        //$request->validate(): ฟังก์ชันที่ใช้ในการตรวจสอบความถูกต้องของข้อมูลที่ผู้ใช้กรอกมา
        $credentials = $request->validate([

        'email' => 'required|string|email|max:64',
        'password' => 'required|string|min:8|max:24',
     ],

     [
        'email.required' => 'Email is required',
        'email.email' => 'Email must be a valid email address',
        'password.required' => 'Password is required',
        'password.string' => 'Password must be a string',
        'password.min' => 'Password must be at least 8 characters',
        'password.max' => 'Password cannot exceed 24 characters',
     ]);
     //Auth::attempt(): ฟังก์ชันที่ใช้ในการตรวจสอบข้อมูลการเข้าสู่ระบบ

     if(Auth::attempt($credentials)){
        // Successful login
        return redirect()->route('dashboard');
     }  
        // Failed login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // ฟังก์ชันแสดงหน้าแดชบอร์ด
    public function dashboard()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ dashboard.blade.php
        return view('dashboard');
    }

    public function stock()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ stock.blade.php
        return view('stock');
    }


    public function order()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ order.blade.php
        return view('order');
    }

    public function report()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ report.blade.php
        return view('report');
    }

    public function profile()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ profile.blade.php
        return view('profile');
    }


    public function setting()
    {
        // ส่งข้อมูลผู้ใช้ไปยัง view ที่ชื่อ setting.blade.php
        return view('setting');
    }

    // ฟังก์ชันออกจากระบบ
    public function logout()
    {
        // ออกจากระบบ
        Auth::logout();

        // ส่งผู้ใช้ไปยังหน้าล็อกอิน
        return redirect()->route('login');
    }
}
