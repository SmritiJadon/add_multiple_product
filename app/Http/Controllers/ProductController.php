<?php 
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('index');
    }

    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
{
    $request->validate([
        'inputs.*.title' => 'required',
        'inputs.*.description' => 'required',
        'inputs.*.quantity' => 'required|integer',
        'inputs.*.price' => 'required|numeric',
        'inputs.*.date' => 'required|date',
        'inputs.*.picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    foreach ($request->inputs as $input) {
        $productData = [
            'title' => $input['title'],
            'description' => $input['description'],
            'quantity' => $input['quantity'],
            'price' => $input['price'],
            'date' => $input['date'],
        ];

        if (isset($input['picture'])) {
            $picture = $input['picture'];
            $path = $picture->store('pictures', 'public');
            $productData['picture'] = $path;
        }

        Product::create($productData);
    }

    return redirect()->route('products.show')->with('success', 'The products have been added!');
}
    
    public function show(Request $request)
    {
        $query = Product::query();

        if ($title = $request->input('title')) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('date', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('date', '<=', $endDate);
        }

        $products = $query->paginate(10);

        return view('products.show', compact('products'));
    }
    
}
