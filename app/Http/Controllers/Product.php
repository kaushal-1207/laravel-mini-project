<?php

namespace App\Http\Controllers;

use App\Models\ProductData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class Product extends Controller
{
    public function addProducts(Request $request)
    {
        $rules = array(
            'p_name' => 'unique:product_data,name',
        );
        $val = Validator::make($request->all(), $rules);
        if ($val->fails()) {
            $msg = "This Product is Already Exist";
            $request->session()->flash('existsmsg', $msg);
        } else {
            $product_details = new ProductData();
            $p_name = $request->get('p_name');
            if($p_name == ''){
                $msg = "Product Name is Required";
                $request->session()->flash('reqmsg', $msg);
                return redirect('admin/add_products');
            }else{
                $product_details->name = $request->p_name;
            }
            $image = $request->file('p_image');
            if($image)
            {
                $image_name = time(). '.' .$image->getClientOriginalName();
                $path = public_path('/productimage');
                $image->move($path,$image_name);
                $product_details->image = $image_name;
            }else{
                $product_details->image = '';
            }
            $product_details->price = $request->p_price;
            $saveData = $product_details->save();
            if ($saveData) {
                $msg = "Product Added Successfully";
                $request->session()->flash('successmsg', $msg);
            } else {
                $msg = "Something went wrong to Add Product";
                $request->session()->flash('failedmsg', $msg);
            }
        }
        return redirect('admin/add_products');
    }

    public function viewProducts()
    {
        $showdetails = ProductData::paginate(3);
        //Applying Style to Paginator
        Paginator::useBootstrap();
        $number_of_rows = DB::table('product_data')->count();
        return view('admin/view_products',['productdetails'=>$showdetails,'number_of_rows'=>$number_of_rows]);
    }

    public function deleteProducts($id)
    {
        $record_details = ProductData::find($id);
        $Data = $record_details->delete();
        if($Data){
            $msg = "Product Deleted Successfully";
            session()->flash('deletemsg', $msg);
        }else{
            $msg = "Something went wrong to Delete Product";
            session()->flash('errordelmsg', $msg);
        }
        return redirect('admin/view_products');
    }

    public function editProductForm($id)
    {
        $data = ProductData::find($id);
        return view('admin/edit_products',['editdetails'=>$data]);
    }

    public function editProducts(Request $request)
    {
        $data = ProductData::find($request->update_id);
        $data->name = $request->p_name;
        $data->price = $request->p_price;
        $image = $request->file('p_image');
        if($image)
        {
            $image_name = time(). '.' .$image->getClientOriginalName();
            $path = public_path('/productimage');
            $image->move($path,$image_name);
            $data->image = $image_name;
        }
        $saveData = $data->save();
        if ($saveData) {
            $msg = "Product Details Updated Successfully";
            $request->session()->flash('successmsg', $msg);
        } else {
            $msg = "Something went wrong to Update Product";
            $request->session()->flash('failedmsg', $msg);
        }
        return redirect('admin/view_products');
    }
    
}
