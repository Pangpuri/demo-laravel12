<?php

//model for Userใช้ในการจัดการข้อมูลผู้ใช้ในฐานข้อมูล
//และการตรวจสอบสิทธิ์ผู้ใช้ในระบบ
//ไฟล์นี้ถูกสร้างขึ้นโดยค่าเริ่มต้นเมื่อใช้คำสั่ง
//"php artisan make:auth" หรือ "php artisan ui vue --auth"

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//HasFactory: ช่วยให้สามารถสร้างแฟคทอรีสำหรับโมเดลนี้ได้
//Authenticatable: คลาสพื้นฐานที่ใช้สำหรับการตรวจสอบสิทธิ์ผู้ใช้
//Notifiable: ช่วยให้โมเดลนี้สามารถส่งการแจ้งเตือนไปผู้ใช้ได้

class User extends Authenticatable

{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', // ชื่อผู้ใช้
        'email', // อีเมลผู้ใช้
        'phone', // เบอร์โทรศัพท์ผู้ใช้
        'address', // ที่อยู่ผู้ใช้
        'password', // รหัสผ่านผู้ใช้
        'email_verified_at', // เวลาที่อีเมลได้รับการยืนยัน
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
