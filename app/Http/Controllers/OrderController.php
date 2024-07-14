<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

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
}
