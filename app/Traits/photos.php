<?php

namespace App\Traits;


Trait photos  
{
    public function save_photo($image,$folder){
        
        // save photo in folder
       $file_extension=$image->getClientOriginalExtension();
       $file_name=time().'.'.$file_extension;
       $path = public_path('assets/images/' . $folder);
       if (!file_exists($path)) {
           @mkdir($path, 0777, true);
       }
       $image->move($path, $file_name);
       return $file_name;
   }
}
