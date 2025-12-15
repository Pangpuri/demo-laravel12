<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //เรียกใช้ trait HasFactory
// Trait คือกลุ่มของฟังก์ชันที่สามารถนําไปใช้ซ้ำในคลาสต่างๆ ได้
// ใช้เพื่อเพิ่มความสามารถให้กับคลาสโดยไม่ต้องใช้การสืบทอดหลายชั้น
// ช่วยลดการซ้ำซ้อนของโค้ดและส่งเสริมการนําแนวคิด DRY (Don't Repeat Yourself)
// โดยการนํา Trait มาใช้ในคลาส เราสามารถเพิ่มฟังก์ชันการทํางานให้กับคลาสนั้นได้อย่างง่ายดาย
// โดยไม่ต้องแก้ไขโครงสร้างของคลาสหลัก

//แล้ว hasFactory คืออะไร
// HasFactory เป็น Trait ที่มีอยู่ใน Laravel ซึ่งใช้เพื่อช่วยในการสร้าง Factory สำหรับโมเดล Eloquent
// Factory เป็นเครื่องมือที่ช่วยให้เราสามารถสร้างข้อมูลตัวอย่าง (dummy data) ได้อย่างง่ายดาย
// โดยเฉพาะในระหว่างการทดสอบหรือการพัฒนาแอปพลิเคชัน
// เมื่อเราใช้ HasFactory ในโมเดลของเรา เราจะสามารถเรียกใช้เมธอด factory() เพื่อสร้างอินสแตนซ์ของ Factory ที่เกี่ยวข้องกับโมเดลนั้นได้
// ซึ่งช่วยให้เราสามารถสร้างข้อมูลตัวอย่างได้อย่างรวดเร็วและมีประสิทธิภาพ

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //database table name
    protected $table = 'employees'; //ระบุชื่อตารางจริงที่ต้องการเชื่อมต่อ
    protected $primaryKey = 'id'; //ระบุ primary key ของตาราง
    public $timestamps = false; //ปิดการใช้งาน timestamps ถ้าไม่ต้องการให้ Eloquent จัดการคอลัมน์ created_at และ updated_at
    public $filelable = [
        'fullname',
        'gender',
        'email',
        'tel',
        'age',
        'address',
        'avatar'        
    ];

}
