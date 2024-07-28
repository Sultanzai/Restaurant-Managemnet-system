<?php

namespace App\Http\Controllers;
use App\Models\StorageView;
use App\Models\StorageMainView;
use App\Models\Storage;
use App\Models\StorageDetail;
use Carbon\Traits\ToStringFormat;
use DB;
use App\Models\Log;
use Auth;

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
        $request->validate([
            'unit' => 'integer',
            'price' => 'nullable|numeric',
            'type' => 'nullable|max:255',
            'status' => 'string|max:255',
            ]);

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
        return redirect('/StoragePage')->with('success','');
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

        Log::create([
            'username' => Auth::user()->name,
            'state' => 'Storage deleted',
            'item_name' => 'ID Number ' . $storageid->Storage_ID . ' is Deleted from Storage table',
            'item_id' => $storageid->Storage_ID,
            'price' => $storageid->S_Price * $storageid->S_Unit,
        ]);

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
