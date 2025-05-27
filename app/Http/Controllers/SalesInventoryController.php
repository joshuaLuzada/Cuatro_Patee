<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Sale;
use App\Models\User;
use App\Models\Account;
use Illuminate\Support\Str; 

// Example for your controller


class SalesInventoryController extends Controller
{
    
    public function index()
    {
        return view('log');
        
    }
    public function home()
    {
         $lowStocks = \App\Models\Product::where('stock', '<=', 10)->get();
        $transactions = \App\Models\Transaction::latest()->take(10)->get();
        return view('home', compact('lowStocks', 'transactions'));
    }
    public function inventory()
    {
        $products = \App\Models\Product::all();
        return view('inventory', compact('products'));
    }   
    

   
    
    public function orders()
    {
        return view('orders');
    }
    public function reports(Request $request)
    {
        $query = \App\Models\Report::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('about', 'like', "%{$search}%");
            $query->orWhere('created_at', 'like', "%{$search}%");
            $query->orWhere('id', 'like', "%{$search}%");
        }

        $reports = $query->orderBy('created_at', 'asc')->get();

        return view('reports', compact('reports'));
    }
    public function sales()
    {
        $products = \App\Models\Product::all();
        return view('sales', compact('products'));
    }
    public function receipt()
    {
        return view('receipt');
    }
   








    
   public function account(Request $request)
{
   $query = \App\Models\Account::query();
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('id', 'like', "%{$search}%")
            ->orWhere('username', 'like', "%{$search}%")
            ->orWhere('role', 'like', "%{$search}%");
        });
    }
    $accounts = $query->get();
    return view('account', compact('accounts'));
}
    public function storeAccount(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:accounts,email',
        'username' => 'required|string|max:255|unique:accounts,username',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|in:admin,staff',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $account = new \App\Models\Account();
    $account->name = $request->name;
    $account->email = $request->email;
    $account->username = $request->username;
    $account->password = Hash::make($request->password);
    $account->role = $request->role;

    if ($request->hasFile('image')) {
        $account->image = $request->file('image')->store('accounts', 'public');
    }

    $account->save();

    return redirect()->route('accounts.index'); // <--- THIS IS IMPORTANT
}
    public function updateAccount(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email,' . $id,
            'username' => 'required|string|max:255|unique:accounts,username,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,staff',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $account = \App\Models\Account::findOrFail($id);
        $account->name = $request->name;
        $account->email = $request->email;
        if ($request->password) {
            $account->password = Hash::make($request->password);
        }
        $account->username = $request->username;
        $account->role = $request->role;

        if ($request->hasFile('image')) {
            $account->image = $request->file('image')->store('accounts', 'public');
        }

        $account->save();

        \App\Models\Report::create([
            'about' => 'Updated account: ' . $request->name,
            'created_at' => now(),
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }
    public function deleteAccount($id)
    {
        $account = \App\Models\Account::findOrFail($id);
        $accountName = $account->name;
        $account->delete();

        \App\Models\Report::create([
            'about' => 'Deleted account: ' . $accountName,
            'created_at' => now(),
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully!');
    }

    







   

















public function products(Request $request)
    {
        $query = \App\Models\Product::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('price', 'like', "%{$search}%")
                ->orWhere('stock', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
    }

    $products = $query->get();
     return view('products', compact('products'));
}
public function storeProduct(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['name', 'price', 'stock', 'description']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product = \App\Models\Product::create($data);


    

    \App\Models\Report::create([
        'about' => 'Added product: ' . $request->name,
        'created_at' => now(),
    ]);

    return redirect()->route('products.index')->with('success', 'Product and sale posted!');
}
 
public function updateProduct(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image
    ]);

    $product = \App\Models\Product::findOrFail($id);
    $data = $request->only(['name', 'price', 'stock', 'description']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    \App\Models\Report::create([
        'about' => 'Updated product: ' . $request->name,
        'created_at' => now(),
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated!');

}

public function deleteProduct($id)
{
    $product = \App\Models\Product::findOrFail($id);
    $productName = $product->name;
    $product->delete();

    \App\Models\Report::create([
        'about' => 'Deleted product: ' . $productName,
        'created_at' => now(),
    ]);

    return redirect()->route('products.index')->with('success', 'Product deleted!');
}



}

