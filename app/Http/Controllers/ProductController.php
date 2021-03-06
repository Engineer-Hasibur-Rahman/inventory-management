<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
  // add Product view page
  public function AddProduct()
  {
    $categories = Category::latest()->get();  
      return view('product.AddProduct',compact('categories'));
  }
 
 
  // public function ProductList()
  // {
  //   $products=Product::all();
  //     return view('product.ProductList',compact('products'));
  // }

  
  public function StoreProduct(Request $request)
  {
    
       $validateData = $request->validate([
           'name' => 'required',
           'price' => 'required',
           'product_code' => 'required',
           'squ_code' => 'required',
           'count' => 'required',



          
       ]);
      $image = $request->file('image');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      Image::make($image)->resize(917,1000)->save('products/'.$name_gen);
      $save_url = 'products/'.$name_gen;
      $product= new Product;
      $product->name=$request->name;
      $product->category_id=$request->category_id;
      $product->price=$request->price;
      $product->product_code=$request->product_code;
      $product->squ_code=$request-> squ_code;
      $product->count=$request->count;
     
      $product->product_image= $save_url; 
      $product->product_satus= 1; 
      $product->save();
      $notification = array(
        'message' => 'Product Add Sucessyfuly',
        'alert-type' => 'success',
      );
  
      return redirect()->back()->with($notification);
  
    }
  public function showProduct(){
    $products = Product::all();

    return view('Product.ProductList', compact('products'));
}
public function EditProduct($id)
{  
    $product = Product::find($id);
    $categories = Category::latest()->get(); 
    return view('product.ProductEdit',compact('product','categories'));
}

public function UpdateProduct(Request $request,$id)
{    
      $validateData = $request->validate([
    'name' => 'required',
    'price' => 'required',
    'product_code' => 'required',
    'squ_code' => 'required',
    'count' => 'required',



   
]);
      $image = $request->file('image');
      $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
      Image::make($image)->resize(917,1000)->save('products/'.$name_gen);
      $save_url = 'products/'.$name_gen;
          $product=Product::find($id);
          $product->name=$request->name;
          $product->category_id=$request->category_id;
          $product->price=$request->price;
          $product->product_code=$request->product_code;
          $product->squ_code=$request-> squ_code;
          $product->count=$request->count;
         
          $product->product_image= $save_url; 
          $product->product_satus= 1; 
          $product->save();
          $notification = array(
            'message' => 'Product Edited Sucessyfuly',
            'alert-type' => 'success',
          );
      
          return redirect()->back()->with($notification);
      
        }
public function DeleteProduct($id)
{
    Product::destroy($id);
    $notification = array(
      'message' => 'Product deleted Sucessyfuly',
      'alert-type' => 'success',
    );

    return redirect()->back()->with($notification);

  }
    
}






