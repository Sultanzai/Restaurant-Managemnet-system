<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all(); // Retrieve all expenses from the database
        return view('MenuPage', compact('menu')); // Pass the expenses to the view
    }

    public function destroy($id)
    {
        $storageid = Menu::findOrFail($id);
        $storageid->delete();
        return redirect('/MenuPage')->with('success','');
    }
}
