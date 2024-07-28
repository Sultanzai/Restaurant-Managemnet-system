<?php

namespace App\Http\Controllers;
use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Models\Log;
use Auth;
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
        Log::create([
            'username' => Auth::user()->name,
            'state' => 'Expenses Before Update',
            'item_name' => $expense->E_Name,
            'item_id' => $expense->id,
            'price' => $expense->E_Amount,
        ]);
        $request->validate([
            'E_Name' => 'required|string|max:255',
            'E_Type' => 'required|string|max:255',
            'E_Description' => 'required|string',
            'E_Amount' => 'required|numeric',
        ]);

        $expense->update($request->all());

        Log::create([
            'username' => Auth::user()->name,
            'state' => 'Expenses After Update',
            'item_name' => $expense->E_Name,
            'item_id' => $expense->id,
            'price' => $expense->E_Amount,
        ]);

        return redirect()->route('ExpensesPage')->with('success', 'Expense updated successfully.');
    }
    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id);

            Log::create([
                'username' => Auth::user()->name,
                'state' => 'Expenses deleted',
                'item_name' => $expense->E_Name,
                'item_id' => $expense->id,
                'price' => $expense->E_Amount,
            ]);
        $expense->delete();
        return redirect()->route('ExpensesPage')->with('success', 'Expense deleted successfully');
    }

    public function logs()
    {
        $log = log::all(); // Retrieve all expenses from the database
        return view('log', compact('log')); // Pass the expenses to the view
    }
 }
