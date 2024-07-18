<?php

namespace App\Http\Controllers;
use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::all(); // Retrieve all expenses from the database
        return view('ExpensesPage', compact('expenses')); // Pass the expenses to the view
    }
    public function Report()
    {
        $expenses = Expenses::all(); // Retrieve all expenses from the database
        $totalAmount = $expenses->sum('E_Amount'); // Total amount 
        return view('ExpensesReport', compact('expenses','totalAmount')); // Pass the expenses to the view
    }
    public function edit($id)
    {
        $expense = Expenses::find($id);
        if (!$expense) {
            return redirect()->route('ExpensesPage')->with('error', 'Expense not found.');
        }
        return view('UpdateExpenses', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $expense = Expenses::find($id);
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
    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();
        return redirect()->route('ExpensesPage')->with('success', 'Expense deleted successfully');
    }
 }
