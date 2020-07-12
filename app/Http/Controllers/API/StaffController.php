<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        return Staff::all();
    }
 
    public function show($id)
    {
        return Staff::find($id);
    }
}
