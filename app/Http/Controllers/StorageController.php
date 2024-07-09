<?php

namespace App\Http\Controllers;
use App\Models\StorageView;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storage = StorageView::all(); // Retrieve all expenses from the database
        return view('StoragePage', compact('storage')); // Pass the expenses to the view
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
