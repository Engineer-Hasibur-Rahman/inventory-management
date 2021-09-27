<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
   // add Category view page
   public function AddCategory()
   {
      
       return view('category.AddCategory');
   }
  
   // Category list View page

   
        public function StoreCategory(Request $request)
        {
            $validateData = $request->validate([
                'category_name' => 'required',
                
            ]);
            $cat= new Category;
            $cat->category_name=$request->category_name;
           
            
            $cat->save();
            $notification = array(
                'message' => 'Product Add Sucessyfuly',
                'alert-type' => 'info',
              );
          
              return redirect()->back()->with($notification);
          
            
            
        }


   public function CategoryList()
   {
    $categories  = Category::all();
       return view('category.CategoryList',compact('categories'));
   }

   public function EditCategory($id)
{  
    $category = Category::find($id);
    return view('category.CategoryEdit',compact('category'));
}

public function UpdateCategory(Request $request,$id)
{    
    $validateData = $request->validate([
    'category_name' => 'required',
    
]);
    $category=Category::find($id);
    $category->category_name=$request->category_name;
    $category->save();
  return redirect('category/list');
}
public function DeleteCategory($id)
{
    Category::destroy($id);
    return redirect('category/list');
    
}

}



// // update admin
// public function UpdateAdmin(Request $request,$id)
// {
// $admin=Admin::find($id);
// $admin->username=$request->username;
// $admin->fullname=$request->fullname;
// $admin->email=$request->email;


//       if($request->hasFile('image') && $request->image->isValid()){
//         if(file_exists(public_path('admin_img/'.$admin->image))){
//             unlink(public_path('admin_img/'.$admin->image));
//         }
//         $newImageName=time().'-'.$request->username.'.'.$request->image->extension();
//         $image=$request->image->move(public_path('admin_img'),$newImageName);
//         $admin->image=$newImageName;
//     }
// $admin->save();
// return redirect('admin/list');
// }

