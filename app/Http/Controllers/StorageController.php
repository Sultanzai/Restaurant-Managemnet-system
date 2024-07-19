<?php

namespace App\Http\Controllers;
use App\Models\StorageView;
use App\Models\StorageMainView;
use App\Models\Storage;
use App\Models\StorageDetail;
use DB;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storage = StorageView::all(); // Retrieve all  from the database
        return view('StoragePage', compact('storage')); // Pass the to the view
    }
    public function showItems()
    {
        $storage = Storage::all(); // Retrieve all  from the database
        return view('AddItems', compact('storage')); // Pass the  to the view
    }

    public function AddItems(Request $request)
    {
        $summary = DB::table('storage_main_view')
            ->select(
                DB::raw('total_in'),
                DB::raw('total_out'),
                DB::raw('total_expired')
            )
            ->first();

        $totalIn = $summary->total_in;
        $totalOut = $summary->total_out;
        $totalExpired = $summary->total_expired;
        $remaining = $totalIn - $totalOut - $totalExpired; 

        $request->validate([
            'unit' => 'integer',
            'price' => 'nullable|numeric',
            'type' => 'nullable|max:255',
            'status' => 'string|max:255',
        ]);

        if ($remaining < $request->unit) {
            return redirect()->back()->with('error', 'Storage is low in units.');
        }

        $storagedetail = StorageDetail::create([
            'S_Unit' => $request->unit,
            'S_Type' => $request->type,
            'S_Price' => $request->price,
            'S_Status' => $request->status,
            'Storage_ID' => $request->storage_id
        ]);
        
        if (!$storagedetail) {
            throw new \Exception('Item detail creation failed');
        }
        
        return redirect('/StoragePage')->with('success', 'Item added successfully.');
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
    public function destroy($id)
    {
        $storageid = StorageDetail::findOrFail($id);
        $storageid->delete();
        return redirect('/StoragePage')->with('success','');
    }

    // Storage Report ======================================================================
    public function Report()
    {
        $storage = DB::table('storage_view')
            ->get();
            
            if ($storage->isEmpty()) {
                return redirect()->back()->with('error', 'Order not found.');
            }

        $totalAmount = $storage->sum('S_Price'); // Total amount 
        return view('StorageReport', compact('storage', 'totalAmount'));
    }

    // Displaying storage data in Dashboard 
    public function dashboard()
    {
        $storage = StorageMainView::all(); // Retrieve all  from the database
        return view('dashboard', compact('storage')); // Pass the to the view
    }


}
