<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\OrderDetailsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Auth;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails.menu')->orderBy('id', 'desc')->get();

        $orderData = $orders->map(function ($order) {
            $totalMenuPrice = $order->orderDetails->sum(function ($orderDetail) {
                return $orderDetail->menu->m_Price * $orderDetail->OD_Units;
            });
            $menuNames = $order->orderDetails->pluck('menu.m_Name')->unique()->implode(', ');
            $odUnits = $order->orderDetails->sum('OD_Units');
            $odPrices = $order->orderDetails->sum('OD_Price');
    
            return [
                'Order_ID' => $order->id,
                'O_Name' => $order->O_Name,
                'O_Status' => $order->O_Status,
                'O_Description' => $order->O_Description,
                'Menu_Names' => $menuNames,
                'OD_Units' => $odUnits,
                'OD_Prices' => $odPrices,
                'Total_Menu_Price' => $totalMenuPrice,
                'Menu_Category' => $order->orderDetails->first()->menu->m_category ?? ''
            ];
        });
    
        return view('OrderPage', compact('orderData'));
    }



    // Add Order ==================================================================
    public function create()
    {
        $categories = Menu::select('m_category')->distinct()->get();
        $menus = Menu::all();
        return view('AddOrder', compact('categories', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'O_Name' => 'required|string',
            'O_Status' => 'required|string',
            'O_Description' => 'nullable|string',
            'items' => 'required|array',
            'items.*.Menu_ID' => 'required|exists:tbl__menus,id',
            'items.*.OD_Units' => 'required|integer|min:1',
            'items.*.OD_Price' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'O_Name' => $request->O_Name,
            'O_Status' => $request->O_Status,
            'O_Description' => $request->O_Description,
        ]);

        foreach ($request->items as $item) {
            OrderDetail::create([
                'Order_ID' => $order->id,
                'Menu_ID' => $item['Menu_ID'],
                'OD_Units' => $item['OD_Units'],
                'OD_Price' => $item['OD_Price'],
            ]);
        }

        return redirect()->route('OrderPage', $order);
    }

    // Edit Order 
    public function edit($id)
    {
        $order = Order::with('orderDetails.menu')->findOrFail($id);
        $categories = Menu::select('m_category')->distinct()->get();
        $menus = Menu::all();
        return view('EditOrder', compact('order', 'categories', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'O_Name' => 'required|string',
            'O_Status' => 'required|string',
            'O_Description' => 'nullable|string',
            'items' => 'required|array',
            'items.*.Menu_ID' => 'required|exists:tbl__menus,id',
            'items.*.OD_Units' => 'required|integer|min:1',
            'items.*.OD_Price' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'O_Name' => $request->O_Name,
            'O_Status' => $request->O_Status,
            'O_Description' => $request->O_Description,
        ]);

         // Log the current details before deleting
        foreach ($order->orderDetails as $detail) {
            Log::create([
                'username' => Auth::user()->name,
                'state' => 'Order Items Before Update',
                'item_name' => $detail->menu->m_Name,
                'item_id' => $detail->id,
                'price' => $detail->OD_Price,
            ]);
        }

        // Delete existing order details
        OrderDetail::where('Order_ID', $id)->delete();
        
        // Add updated order details
        foreach ($request->items as $item) {
            OrderDetail::create([
                'Order_ID' => $order->id,
                'Menu_ID' => $item['Menu_ID'],
                'OD_Units' => $item['OD_Units'],
                'OD_Price' => $item['OD_Price'],
            ]);

                    // Log the new details after update
            Log::create([
                'username' => Auth::user()->name,
                'state' => 'Order Items After Update',
                'item_name' => $item['Menu_ID'],
                'item_id' => $item['Menu_ID'],
                'price' => $item['OD_Units'] * $item['OD_Price'],
            ]);

        }

        return redirect()->route('OrderPage', $order);
    }

    // Delete Order 
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        foreach ($order->orderDetails as $detail) {
            Log::create([
                'username' => Auth::user()->name,
                'state' => 'Order Item deleted',
                'item_name' => $detail->menu->m_Name,
                'item_id' => $detail->id,
                'price' => $detail->OD_Price,
            ]);
        }


        $order->delete();
        return redirect()->route('OrderPage')->with('success', 'Expense deleted successfully');
    }


    // Order Report ======================================================================
    public function Report()
    {
        
        $orders = Order::with('orderDetails.menu')->orderBy('id', 'desc')->get();

        $orderData = $orders->map(function ($order) {
            $totalMenuPrice = $order->orderDetails->sum(function ($orderDetail) {
                return $orderDetail->menu->m_Price * $orderDetail->OD_Units;
            });
            $menuNames = $order->orderDetails->pluck('menu.m_Name')->unique()->implode(', ');
            $odUnits = $order->orderDetails->sum('OD_Units');
            $odPrices = $order->orderDetails->sum('OD_Price');
    
            return [
                'Order_ID' => $order->id,
                'O_Name' => $order->O_Name,
                'O_Status' => $order->O_Status,
                'O_Description' => $order->O_Description,
                'Menu_Names' => $menuNames,
                'OD_Units' => $odUnits,
                'OD_Prices' => $odPrices,
                'Total_Menu_Price' => $totalMenuPrice,
                'Menu_Category' => $order->orderDetails->first()->menu->m_category ?? '',
                'created_at' => $order->created_at->format('Y-m-d')
            ];
        });
    
        $totalAmount = $orderData->sum('Total_Menu_Price');
    
        return view('OrderReport', compact('orderData', 'totalAmount'));
        
    }

    
    // Print Order ======================================================================
    public function show($orderId)
    {
        $orderDetails = DB::table('order_receipt_view')
            ->where('order_id', $orderId)
            ->get();

        if ($orderDetails->isEmpty()) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        return view('PrintOrder', compact('orderDetails'));
    }
}
