<?php

namespace App\Http\Controllers;
use App\Models\StorageView;
use App\Models\Storage;
use App\Models\StorageDetail;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storage = StorageView::all(); // Retrieve all expenses from the database
        return view('StoragePage', compact('storage')); // Pass the expenses to the view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'integer',
            'price' => 'integer',
            'type' => 'string|max:255',
            'status' => 'string|max:255',
            ]);

        $storage = Storage::create([
            's_Name' => $request->name
        ]);

        if (!$storage) {
            throw new \Exception('Item Name creation failed');
        }
        $storageid = $storage->id; 

        $storagedetail = StorageDetail::create([
            'S_Unit' => $request->unit,
            'S_Type' => $request->type,
            'S_Price' => $request->price,
            'S_Status' => $request->status,
            'Storage_ID' => $storageid,
        ]);
        
        if (!$storagedetail) {
            throw new \Exception('Item detail creation failed');
        }
        return redirect('/StoragePage')->with('success','');
    }

    public function insert()
    {
        
    }

    public function edit($id)
    {
        $expense = StorageView::find($id);
        if (!$expense) {
            return redirect()->route('ExpensesPage')->with('error', 'Expense not found.');
        }
        return view('UpdateExpenses', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = StorageView::find($id);
        if (!$expense) {
            return redirect()->route('ExpensesPage')->with('error', 'Expense not found.');
        }

        $request->validate([
            'E_Name' => 'required|string|max:255',
            'E_Type' => 'required|string|max:255',
            'E_Description' => 'required|string',
            'E_Amount' => 'required|numeric',
        ]);

        $expense->update($request->all());

        return redirect()->route('ExpensesPage')->with('success', 'Expense updated successfully.');
    }


}
