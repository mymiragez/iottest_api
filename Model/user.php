<?php
class User
{
    //ตัวแปรที่จะใช้ติดต่อกับ Database
    private $conn;

    //ตัวแปรที่จะทำงานคู่กับแต่ละฟิวล์หรือคอลัมน์ในตาราง
    public $userId;
    public $userFullname;
    public $userName;
    public $userPassword;
    public $userStatus;

    //ตัวแปรที่จะเก็บข้อมูล เพื่อเอาไว้ใช้งานเฉย ๆ
    public $message;

    //คอนสตรักเตอร์ที่จะมีคำสั่งที่ใช้ในการติดต่อกับ database
    public function __construct($db) // underscroll 2 ครั้ง
    {
        $this->conn = $db;
    }

    //ฟังก์ชั่นต่าง ๆ ที่จะทำงานกับ Database ตาม API ที่เราจะทำการสร้างมันขึ้นมา ซึ่งมีมากน้อยแล้วแต่
    //function loginUser ที่ทำงานกับ api_loginuser.php

    function loginUser()
    {
        //คำสั่ง SQL /คำสั่ง SQL  :???????? เรียกว่า พารามิเตอร์ที่จะต้องกำหนดข้อมูลให้มัน
        $strSQL = "SELECT * FROM user_tb WHERE userName = :userName and userPassword = :userPassword";
    
        //กำหนด Statement ที่จะทำงานกับคำสั่ง SQL
        $stmt = $this->conn->prepare($strSQL);

        //ตรวจสอบข้อมูล
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

        //กำหนดข้อมูลให้กับ พารามิเตอร์
        $stmt->bindParam(":userName",$this->userName);
        $stmt->bindParam(":userPassword",$this->userPassword);

        //สั่งให้ SQL ทำงาน
        $stmt->execute();

        //ส่งค่าผลลัพธ์ที่ได้จากคำสั่ง SQL ไปใช้งาน
        return $stmt;
    }
    //function registerUser ที่ทำงานกับ api_registerUser.php
    function registerUser()
    {

    }
    //function updateUser ที่ทำงานกับ api_updateUser.php
    function updateUser()
    {

    }
}
