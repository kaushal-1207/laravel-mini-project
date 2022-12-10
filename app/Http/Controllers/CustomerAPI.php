<?php

namespace App\Http\Controllers;

use App\Models\CustomerData;
use Illuminate\Http\Request;

class CustomerAPI extends Controller
{
    //
    public function viewCustomers()
    {
        $data = CustomerData::all();
        return response($data, 200);
    }
}
