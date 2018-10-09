<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UploadFileController extends Controller
{
    public function import(Request $request)
    {
        $filename=$_FILES["file"]["tmp_name"];
        $con = getdb();
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== false) {
                $sql = "INSERT into users (name,address,email,password,remember_token)
                    values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                $result = mysqli_query($con, $sql);
            }
        }
    }
    public function index()
    {
        return view('layouts.upload');
    }
}
