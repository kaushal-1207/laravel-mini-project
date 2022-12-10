<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerData;
use App\Models\ProductData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class Customer extends Controller
{
    public function addCustomer()
    {
        $data = ProductData::all();
        return view('admin/add_customers', ['productdetails' => $data]);
    }
    
    public function addCustomerForm(Request $request)
    {
        $rules = array(
            'c_contact' => 'unique:customer_data,contact',
            'c_email' => 'unique:customer_data,email',
        );
        $val = Validator::make($request->all(), $rules);
        if ($val->fails()) {
            $msg = "This User is Already Exist";
            $request->session()->flash('existsmsg', $msg);
        } else {
            $customer_details = new CustomerData();
            $customer_details->c_name = $request->c_name;
            $customer_details->email = $request->c_email;
            $customer_details->contact = $request->c_contact;
            $customer_details->product_id = $request->p_id;
            $saveData = $customer_details->save();
            if ($saveData) {
                $msg = "Customer Added Successfully";
                $request->session()->flash('successmsg', $msg);
            } else {
                $msg = "Something went wrong to Add Customer";
                $request->session()->flash('failedmsg', $msg);
            }
        }
        return redirect('admin/add_customers');
    }

    public function viewCustomers()
    {
        // $showdetails = DB::select('select customer_data.id,customer_data.c_name,customer_data.email,customer_data.contact,product_data.name from customer_data,product_data where customer_data.product_id = product_data.id')->get()->paginate(3);
        // $showdetails = DB::table('customer_data')->select("*")->paginate(3);

        $showdetails = DB::table('customer_data')
                            ->join('product_data', 'customer_data.product_id', '=', 'product_data.id')
                            ->select('customer_data.id', 'customer_data.c_name', 'customer_data.email', 'customer_data.contact','product_data.name')
                            ->paginate(4);
                            Paginator::useBootstrap();
        $number_of_rows = DB::table('customer_data')->count();
        return view('admin/view_customers',array ( 'customerdetails' => $showdetails, 'number_of_rows' => $number_of_rows ));
    }

    public function deleteCustomer($id)
    {
        $record_details = CustomerData::find($id);
        $Data = $record_details->delete();
        if($Data){
            $msg = "Customer Deleted Successfully";
            session()->flash('deletemsg', $msg);
        }else{
            $msg = "Something went wrong to Delete Customer";
            session()->flash('errordelmsg', $msg);
        }
        return redirect('admin/view_customers');
    }

    public function editCustomerForm($id)
    {
        $record_details = CustomerData::find($id);
        $product_data = ProductData::all();
        return view('admin/edit_customers',['editcustomerdetails'=>$record_details, 'productdetails' => $product_data]);
    }

    public function editCustomers(Request $request)
    {
        $data = CustomerData::find($request->update_id);
        $data->c_name = $request->c_name;
        $data->email = $request->c_email;
        $data->contact = $request->c_contact;
        $data->product_id = $request->p_id;
        $saveData = $data->save();
        if ($saveData) {
            $msg = "Customer Details Updated Successfully";
            $request->session()->flash('successmsg', $msg);
        } else {
            $msg = "Something went wrong to Update Customer";
            $request->session()->flash('failedmsg', $msg);
        }
        return redirect('admin/view_customers');
    }

    public function customerInvoice(Request $request, $id)
    {
        // $showdetails = DB::select('select customer_data.id,customer_data.c_name,customer_data.email,customer_data.contact,product_data.name from customer_data,product_data where customer_data.product_id = product_data.id and customer_data.id = '.$id);
        // // $number_of_rows = DB::table('customer_data')->count();
        $customer_details = CustomerData::find($id);
        $product_data = ProductData::where('id',$customer_details['product_id'])->first();
        return view('admin/invoice',['customerdetail'=> $customer_details, 'productdetail'=> $product_data]);
    }
}
