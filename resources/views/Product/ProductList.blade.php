
 @extends('./layout_master')

{{-- section id is yeild name  --}}

@section('admin')

<div class="content-page center">
   <div class="content">

       <!-- Start Content-->
       <div class="container-fluid">

           <div class="row">
               <div class="col-12">
                   <div class="card">
                       <div class="card-body">

                           <h4 class="header-title">Product List</h4>
                          
                           <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                               <thead>
                                   <tr>
                                       <th>Product image</th>
                                       <th>Product Name</th>
                                       <th>Squ code</th>
                                   
                                       <th>Product Price </th>
                                       <th>Product Count</th>
                                       
                                       <th>Action</th>
                                   </tr>
                               </thead>
                           
                           
                               <tbody>
                                   @foreach($products as $product)
                                   <tr>
                                       <td> 
                                       <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                                    <img src="{{asset($product->product_image)}}" alt="" class="img-thumbnail rounded-circle" >
                                                </span>
                                            </div>
                                           
                                               
                                              
                                              
                                          

                               
                                       </td>
                                       <td>{{$product->name}}</td>
                                       <td>{{$product->squ_code}}</td>
                                       <td>{{$product->price}}</td>
                                       <td>{{$product->count}}</td>
                                    
                                      
                                       <td>
                                   <a href="/edit/product/{{$product->id}}" class="btn btn-primary">Edit</a>
                                   <a href="/delete/product/{{$product->id}}" class="btn btn-danger">Delete</a>
                                       </td>
                                   </tr>
                                   @endforeach
                               </tbody>
                           </table>
                           
                       </div> <!-- end card body-->
                   </div> <!-- end card -->
               </div><!-- end col-->
           </div>
       </div>
   </div>
</div>
@endsection