<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $rsetCategory = Kategori::all();
        return $rsetCategory;

    }
}
