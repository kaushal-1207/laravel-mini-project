<?php

namespace App\Http\Controllers;

use App\Models\ProductData;
use Illuminate\Http\Request;

class ProductAPI extends Controller
{
    //
    public function viewProducts()
    {
        $data = ProductData::all();
        return response($data, 200);
    }
}
