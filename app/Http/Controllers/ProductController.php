<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MultiUpload;
use Illuminate\Http\Request;
use file;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productUpload(Request $request)
      { // print_r($_FILES);

        // $data=$request->file('files');
        // return ($data);
       

        $this->validate($request,[
            'proName'=>'required',
            'proPrice'=>'required',
            'proQuanity'=>'required',
            'files'=>'required',
        ]);
        $image = $_POST['files'];

      $location = "image/";

      $image_parts = explode(";base64,", $image);

      $image_base64 = base64_decode($image_parts[1]);

      $filename = "images_".uniqid().'.png';

      $file = $location . $filename;

      file_put_contents(public_path($file), $image_base64);
     $files = "/public/image/".$filename;

   $product =New Product();  
   $product->proName=$request['proName'];
   $product->proPrice=$request['proPrice'];
   $product->proQuanity=$request['proQuanity'];
   $product->proImage= $files ;
     $product->save();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiUpload(Request $request)
    {   $request->validate([
        'images' => 'required',
        'images.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf'
      ]);
  
          if($request->hasfile('images')) {
          foreach($request->file('images') as $file)
          {
              $name = $file->getClientOriginalName();
              $file->move(public_path('image'), $name); 
  
  
              $imgData[] = $name;  
          }
          $img = implode(",", $imgData); 
  
          $fileModal = new MultiUpload();
          $fileModal->images = json_encode($img);
          
         
          $fileModal->save();
  
         return back()->with('success', 'File is successfully uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
