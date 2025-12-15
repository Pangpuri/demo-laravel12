<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\log;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //เรียกดูข้อมูลในตาราง employees แบบ Query Builder
    public function index(){
        $employees = DB::table('employees')->get();

        // dump($employees);

        // dd($employees);

        // echo"<pre>";
        // print_r($employees);
        // echo"</pre>";
    
        //อ่านแบบรายการเดียว
        $employees = DB::table('employees')->first();

        //อ่านข้อมูลพนักงานที่มี id = xx
        $employees = DB::table('employees')->where('id', 3)->first();

        //อ่านข้อมูลที่มี id and name
        $employees = DB::table('employees')->where('id', 3)->where('fullname', 'Michael Smith')->first();

        //อ่านข้อมูลที่มี id or name
        $employees = DB::table('employees')->where('id', 5)->orWhere('fullname', 'Michael Smith')->first();

        //ค้านหข้อมูลในลักษณะต่างๆ
        $employees = DB::table('employees')->orwhere([
            ['id', 3],
            ['fullname', 'john doe'] //ค้นหาจากค่าสุดท้ายก่อน
        ])->first();

        //เรียงลำดับข้อมูลจากมากไปน้อย
        $employees = DB::table('employees')->orderBy('id', 'desc')->get();

        //limit และ offset ข้อมูล
        $employees = DB::table('employees')->offset(1)->limit(2)->get();

        //สร้างเงื่อนไข like
        $employees = DB::table('employees')->where('fullname', 'like', '%Doe%')->get();

        //ดึงข้อมูลบางคอลัมน์ ด้วย select
        $employees = DB::table('employees')->select('id', 'fullname')->get();

        //ดึงข้อมูลแบบ between
        $employees = DB::table('employees')->whereBetween('id', [2,4])->get();

        //หน้าค่า max min avg sum 
        $employees = DB::table('employees')->max('age'); //สูงสุด
        $employees = DB::table('employees')->min('age'); //ต่ำสุด
        $employees = DB::table('employees')->avg('age'); //ค่าเฉลี่ย
        $employees = DB::table('employees')->sum('age'); //ผลรวม

        //age <= 30
        $employees = DB::table('employees')->where('age', '>=', 30)->get();
        
        //แสดงผลข้อมูลแบบ json
        return response()->json($employees);
       
        //log
        // Log::info('Employees:', $employees->toArray());

        // return response()->json($employees, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


    }

    //เรียกดูและจัดการตารางแบบ Eloquent ORM ในตาราง employees
    public function employeelist(){

        //ดึงข้อมูลในตาราง employees ทั้งหมด
        $employees = Employee::all(); //SQL: SELECT * FROM employees;

        //ดึงข้อมูลพนักงานที่มี id = xx
        $employees = Employee::find(3); //SQL: SELECT * FROM employees WHERE id

        //ดึงข้อมูลพนักงานที่มีเงื่อนไข
        $employees = Employee::where('age', '>=', 30)->get(); //SQL: SELECT * FROM employees WHERE age >= 30;

        //ดึงข้อมูลพนักงานที่มีเงื่อนไข and or
        $employees = Employee::where('age', '>=', 30)->where('gender', 'Male')->get(); //SQL: SELECT * FROM employees WHERE age >= 30 AND gender = 'Male';

        //ดึงข้อมูล like
        $employees = Employee::where('fullname', 'like', '%Doe%')->get(); //SQL: SELECT * FROM employees WHERE fullname LIKE '%Doe%';   

        //จัดเรียงข้อมูล เรียงจากมากไปน้อย
        $employees = Employee::orderBy('age', 'desc')->get();//SQL: SELECT * FROM employees ORDER BY age DESC;

        //จำกัดจำนวนข้อมูล limit offset
        $employees = Employee::offset(1)->limit(2)->get(); //SQL: SELECT * FROM employees LIMIT 2 OFFSET 1;

        //หาค่าสูงสุด ต่ำสุด ค่าเฉลี่ย ผลรวม
        $employees = Employee::max('age'); //SQL: SELECT MAX(age) FROM employees;
        $employees = Employee::min('age'); //SQL: SELECT MIN(age) FROM employees;
        $employees = Employee::avg('age'); //SQL: SELECT AVG(age) FROM employees;
        $employees = Employee::sum('age'); //SQL: SELECT SUM(age) FROM employees;

       

        //แสดงผลข้อมูลแบบ json
        // return response()->json($employees);

        //log
        // Log::info('Employees:', $employees->toArray());

         //ดึงข้อมูลในตาราง employees ทั้งหมด
        $employees = Employee::all(); //SQL: SELECT * FROM employees;

        //return view with data
        return view('employeelist', compact('employees'));
    }

    //ฟอร์มเพิ่มพนักงาน
    public function create()
    {
        return view('employees_create');
    }

    //ฟังก์ชันบันทึกข้อมูลพนักงาน
    public function store(Request $request)
    {
        //validate form data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'age' => 'required|integer|min:18',
            'tel' => 'required|string|max:15',
            'gender' => 'required|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]
        //custom error messages and checking
        ,[
            'fullname.required' => 'Full Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.unique' => 'Email already exists',
            'tel.required' => 'Telephone number is required',
            'tel.max' => 'Telephone number is too long',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be a number',
            'age.min' => 'Age must be at least 18',
            'age.max' => 'Age must be less than 100',
            'gender.required' => 'Gender is required',
            'address.string' => 'Please enter a valid address',
            'avatar.max' => 'Avatar image size must be less than 2MB'

        ]);

        try { 

            $avtarPath = null; //default null avatar path
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
            }

            //create new employee record
            $employee = new Employee();
            $employee->fullname = $request->input('fullname');
            $employee->email = $request->input('email');
            $employee->age = $request->input('age');
            $employee->tel = $request->input('tel');
            $employee->gender = $request->input('gender');
            $employee->address = $request->input('address');
            $employee->avatar = $avatarPath;
            $employee->save();

            //redirect to employee list with success message
            return redirect()->route('employees.employeelist')
                ->with('success', 'Employee created successfully.');

        } catch (\Exception $e) {
            //log error
            Log::error('Error storing employee: '.$e->getMessage());

            //redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while saving the employee data. Please try again.');
        }
        
        return "Store Employee Data";
    }
}
