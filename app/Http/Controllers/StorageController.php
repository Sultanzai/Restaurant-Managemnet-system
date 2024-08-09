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
use Morilog\Jalali\Jalalian;


use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storage = StorageView::all(); // Retrieve all  from the database
         // Convert created_at to Hijri Shamsi date
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
            'unit' => 'numeric',
            'price' => 'nullable|numeric',
            'type' => 'nullable|max:255',
            'status' => 'string|max:255',
        ]);

        $statuses = [$request->status];

        if ($request->status == 'In & Out') {
            $statuses = ['In', 'Out'];
        }

        foreach ($statuses as $status) {
            $storagedetail = StorageDetail::create([
                'S_Unit' => $request->unit,
                'S_Type' => $request->type,
                'S_Price' => $request->price,
                'S_Status' => $status,
                'Storage_ID' => $request->storage_id
            ]);

            if (!$storagedetail) {
                throw new \Exception('Item detail creation failed');
            }
        }

        return redirect('/StoragePage')->with('success', 'Items added successfully');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'numeric',  // Use numeric for floating number validation
            'price' => 'nullable|numeric', // Use numeric for floating number validation
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
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
            $storage = DB::table('storage_view')->get();
    
            if ($storage->isEmpty()) {
                return redirect()->back()->with('error', 'Order not found.');
            }
    
            $storageData = $storage->map(function ($item) {
                // Convert created_at to Hijri Shamsi date
                $hijriDate = Jalalian::fromCarbon(\Carbon\Carbon::parse($item->created_at))->format('Y/m/d');
    
                return [
                    'id' => $item->id,
                    's_Name' => $item->s_Name,
                    'S_Type' => $item->S_Type,
                    'S_Unit' => $item->S_Unit,
                    'S_Price' => $item->S_Price,
                    'S_Status' => $item->S_Status,
                    'created_at' => $hijriDate // Use the Hijri Shamsi date here
                ];
            });
    
            $totalAmount = $storageData->sum('S_Price'); // Total amount 
            return view('StorageReport', compact('storageData', 'totalAmount'));
    }

    // Displaying storage data in Dashboard 
    public function dashboard()
    {
        $storage = StorageMainView::all(); // Retrieve all  from the database
        return view('dashboard', compact('storage')); // Pass the to the view
    }


}
