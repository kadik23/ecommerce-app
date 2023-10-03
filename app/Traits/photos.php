<?php

namespace App\Traits;


Trait photos  
{
    public function save_photo($image,$folder){
        
        // save photo in folder
       $file_extension=$image->getClientOriginalExtension();
       $file_name=time().'.'.$file_extension;
       $path='assets/images/'.$folder;
       $image->move($path,$file_name);
       return $file_name;
   }
}
