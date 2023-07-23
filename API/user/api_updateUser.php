<?php
header("Access-control-allow-origin: *");
header("content-type: application/json; charset=UTF-8");

//ไฟล์ทำงานกับอะไร
include_once "./../../databaseconnect.php";
include_once "./../../model/user.php";


$databaseConnect = new DatabaseConnect();
$connDB = $databaseConnect->getConnection();

$user = new user($connDB); 

$data = json_decode(file_get_contents("php://input"));

$user->userId = $data->userId;
$user->userFullname = $data->userFullname;
$user->userName = $data->userName;
$user->userPassword = $data->userPassword;

//เรียกใช้ ฟังก์ชั่น ตามวัตถุประสงค์ของ API ตัวนี้ มาจาก Model
if ($stmt = $user->updateUser()) {
    //บันทึกสำเร็จ
    http_response_code(200);
    //ส่งข้อมูลไปบอกผู้ใช้ว่าสำเร็จ คือส่ง เลข 1
    echo json_encode(array("message" => "1"));
} else {
    //บันทึกไม่สำเร็จ
    http_response_code(200);
    //ส่งข้อมูลไปบอกผู้ใช้ว่าไม่สำเร็จ คือส่ง เลข 0
    echo json_encode(array("message" => "0"));
};
