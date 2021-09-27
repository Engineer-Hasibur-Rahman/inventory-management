<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Manager;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    // add admin view page
    public function AddAdmin()
    {
       
        return view('admin.AddAdmin');
    }



    // admin store

public function StoreAdmin(Request $request)
{
    $admin= new Admin;
    $admin->username=$request->username;
    $admin->fullname=$request->fullname;
    $admin->email=$request->email;
    $admin->password=$request->password;

    $newImageName=time().'-'.$request->username.'.'.$request->image->extension();
$image=$request->image->move(public_path('admin_img'),$newImageName);
    $admin->image=$newImageName;
       
    $admin->save();
   return view('admin.AddAdmin');
    
}


   
    // admin list View page
    public function AdminList()
    {
       

         $admins = Admin::all();
        return view('admin.AdminList')->with('admins',$admins);
       
    }



    // edit admin view page

    public function EditAdmin($id)
    {  
        $admin = Admin::find($id);
       return view('admin.EditAdmin')->with('admin',$admin);
    }

// update admin
public function UpdateAdmin(Request $request,$id)
{
    $admin=Admin::find($id);
    $admin->username=$request->username;
    $admin->fullname=$request->fullname;
    $admin->email=$request->email;

    
          if($request->hasFile('image') && $request->image->isValid()){
            if(file_exists(public_path('admin_img/'.$admin->image))){
                unlink(public_path('admin_img/'.$admin->image));
            }
            $newImageName=time().'-'.$request->username.'.'.$request->image->extension();
            $image=$request->image->move(public_path('admin_img'),$newImageName);
            $admin->image=$newImageName;
        }
  $admin->save();
  return redirect('admin/list');
}
// delete admin
public function DeleteAdmin($id)
{
    Admin::destroy($id);
    return redirect('admin/list');
    
}

    // add Manager view page
    public function AddManager()
    {
       
        return view('manager.AddManager');
    }

// store manager
    public function StoreManager(Request $request)
{
    $manager= new Manager;
    $manager->username=$request->username;
    $manager->fullname=$request->fullname;
    $manager->email=$request->email;
    $manager->password=$request->password;

    $newImageName=time().'-'.$request->username.'.'.$request->image->extension();
$image=$request->image->move(public_path('admin_img'),$newImageName);
    $manager->image=$newImageName;
       
    $manager->save();
   return view('manager.AddManager');
    
}
   
    // Manager list View page
    public function ManagerList()
    {
       
        return view('manager.ManagerList');
    }



    
}
