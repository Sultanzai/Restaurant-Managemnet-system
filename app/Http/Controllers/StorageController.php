<?php

namespace App\Http\Controllers;
use App\Models\StorageView;
use App\Models\Storage;
use App\Models\StorageDetail;
use DB;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storage = StorageView::all(); // Retrieve all expenses from the database
        return view('StoragePage', compact('storage')); // Pass the expenses to the view
    }
    public function showItems()
    {
        $storage = Storage::all(); // Retrieve all expenses from the database
        return view('AddItems', compact('storage')); // Pass the expenses to the view
    }

    public function AddItems(Request $request)
    {
        $request->validate([
            'unit' => 'integer',
            'price' => 'nullable|numeric',
            'type' => 'string|max:255',
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
        $storageid->delete();
        return redirect('/StoragePage')->with('success','');
    }


    // Displaying storage data in Dashboard 
    public function dashboard()
    {
        $storages = DB::table('tbl_storage')
        ->leftJoin('tbl_storage__detail', 'tbl_storage.id', '=', 'tbl_storage__detail.Storage_ID')
        ->select('tbl_storage.s_Name',
            'tbl_storage__detail.S_Type',
            'tbl_storage__detail.S_Unit',
            'tbl_storage__detail.S_Price',
            DB::raw('SUM(CASE WHEN S_Status = "In" THEN S_Unit ELSE 0 END) as total_in'),
            DB::raw('SUM(CASE WHEN S_Status = "Out" THEN S_Unit ELSE 0 END) as total_out'),
            DB::raw('SUM(CASE WHEN S_Status = "Expired" THEN S_Unit ELSE 0 END) as total_expired')
        )
        ->groupBy('tbl_storage.id', 'tbl_storage.s_Name', 'tbl_storage__detail.S_Type', 'tbl_storage__detail.S_Unit', 'tbl_storage__detail.S_Price')
        ->get();

    return view('Dashboard', compact('storages'));
    }


}
