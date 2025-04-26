<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingType;
use Illuminate\Http\Request;

class BillingTypeController extends Controller
{
    public function index()
    {
        $billingtype = BillingType::paginate(10);
        return view('management.billingtype.index', compact('billingtype'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required'
        ]);

        BillingType::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return response()->json([
            'message' => 'Billing Type created successfully!',
            'redirect' => route('admin.billingtype.index')
        ]);
    }
}
