<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;

class BillController extends Controller
{
    public function index(){
        $bills = Bill::all();
        return view('BillPage',compact('bills'));
    }
    public function create()
    {
        return view('create_bill');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'B_Number' => 'required|string|max:255',
            'B_Name' => 'required|string|max:255',
            'B_Paid' => 'required|numeric',
            'B_Description' => 'nullable|string',
            'bill_details.*.BD_Name' => 'required|string|max:255',
            'bill_details.*.BD_Price' => 'required|numeric',
            'bill_details.*.BD_Unit' => 'required|integer',
        ]);

        // Calculate the total bill amount
        $totalBillAmount = array_reduce($request->bill_details, function ($carry, $item) {
            return $carry + ($item['BD_Price'] * $item['BD_Unit']);
        }, 0);

        // Create the bill
        $bill = Bill::create([
            'B_Number' => $request->B_Number,
            'B_Name' => $request->B_Name,
            'B_Total' => $totalBillAmount,
            'B_Paid' => $request->B_Paid,
            'B_Description' => $request->B_Description,
        ]);

        // Create the bill details
        foreach ($request->bill_details as $detail) {
            $bill->billDetails()->create($detail);
        }

        return redirect()->route('BillPage')->with('success', 'Bill Created successfully');
    }


    public function edit($id)
    {
        $bill = Bill::with('billDetails')->findOrFail($id);
        return view('UpdateBill', compact('bill'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'B_Number' => 'required|string|max:255',
            'B_Name' => 'required|string|max:255',
            'B_Paid' => 'required|numeric',
            'B_Description' => 'nullable|string',
            'bill_details.*.BD_Name' => 'required|string|max:255',
            'bill_details.*.BD_Price' => 'required|numeric',
            'bill_details.*.BD_Unit' => 'required|integer',
        ]);

        // Find the bill
        $bill = Bill::findOrFail($id);

        // Calculate the total bill amount
        $totalBillAmount = array_reduce($request->bill_details, function ($carry, $item) {
            return $carry + ($item['BD_Price'] * $item['BD_Unit']);
        }, 0);

        // Update the bill
        $bill->update([
            'B_Number' => $request->B_Number,
            'B_Name' => $request->B_Name,
            'B_Total' => $totalBillAmount,
            'B_Paid' => $request->B_Paid,
            'B_Description' => $request->B_Description,
        ]);

        // Delete old bill details
        $bill->billDetails()->delete();

        // Create the new bill details
        foreach ($request->bill_details as $detail) {
            $bill->billDetails()->create($detail);
        }

        return redirect()->back()->with('success', 'Bill updated successfully!');
    }
    
    // Print Order ======================================================================
    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        $billdetail = BillDetail::where('Bill_ID', $id)->get();

        return view('PrintBill', compact('bill', 'billdetail'));
    }
    
    // 
    public function destroy($id)
    {
        $bills = Bill::findOrFail($id);
        $bills->delete();
        return redirect()->route('BillPage')->with('success', 'Bill deleted successfully');
    }
}
