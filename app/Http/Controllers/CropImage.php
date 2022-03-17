<?php

namespace App\Http\Controllers;

use App\image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class CropImage extends BaseController
{
    public function loadImage()
    {
       return view('cropImage');
    }
    public function cropImg()
    {
          $data = $_POST['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $image_name = 'upload/' . time() . '.png';
            file_put_contents($image_name, $data);
            echo $image_name;
    }

    
}
