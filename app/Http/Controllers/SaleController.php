<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SoldProduct;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PaimentMethod;
use \Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::latest()->paginate(25);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $customers = Customer::all();

        return view('sales.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
        $existent = Sale::where('customer_id', $request->get('customer_id'))->where('finalized_at', null)->get();

        if ($existent->count()) {
            return back()->withError('Il y a déjà une vente inachevée appartenant à ce client. <a href="' . route('sales.show', $existent->first()) . '">Click here to go to it</a>');
        }

        $sale = $sale->create($request->all());

        return redirect()
            ->route('sales.show', ['sale' => $sale->id])
            ->withStatus('Vente enregistrée avec succès, vous pouvez commencer à enregistrer des produits et des transactions.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {

        $sale->delete();

        return redirect()
            ->route('sales.index');

    }



    public function finalize(Sale $sale)
    {
        $sale->total_amount = $sale->products->sum('total_amount');

        foreach ($sale->products as $sold_product) {
            $product_name = $sold_product->product->name;
            $product_stock = $sold_product->product->stock;
            if ($sold_product->qty > $product_stock) return back()->withError("The product '$product_name' does not have enough stock. Only has $product_stock units.");
        }

        foreach ($sale->products as $sold_product) {
            $sold_product->product->stock -= $sold_product->qty;
            $sold_product->product->save();
        }

        $sale->finalized_at = Carbon::now()->toDateTimeString();
        $sale->customer->balance -= $sale->total_amount;
        $sale->save();
        $sale->customer->save();

        return back()->withStatus('The sale has been successfully completed.');
    }



    public function addproduct(Sale $sale)
    {
        $products = Product::all();

        return view('sales.addproduct', compact('sale', 'products'));
    }
    public function storeproduct(Request $request, Sale $sale, SoldProduct $soldProduct)
    {
        $request->merge(['total_amount' => $request->get('price') * $request->get('qty')]);

        $soldProduct->create($request->all());

        return redirect()
            ->route('sales.show', ['sale' => $sale])
            ->withStatus('Product successfully registered.');
    }

    public function editproduct(Sale $sale, SoldProduct $soldproduct)
    {
        $products = Product::all();

        return view('sales.editproduct', compact('sale', 'soldproduct', 'products'));
    }

    public function updateproduct(Request $request, Sale $sale, SoldProduct $soldproduct)
    {
        $request->merge(['total_amount' => $request->get('price') * $request->get('qty')]);

        $soldproduct->update($request->all());

        return redirect()->route('sales.show', $sale)->withStatus('Product successfully modified.');
    }

    public function destroyproduct(Sale $sale, SoldProduct $soldproduct)
    {
        $soldproduct->delete();

        return back()->withStatus('The product has been disposed of successfully.');
    }

    public function addtransaction(Sale $sale)
    {
        $paiment_methods = PaimentMethod::all();

        return view('sales.addtransaction', compact('sale', 'paiment_methods'));
    }

    public function storetransaction(Request $request, Sale $sale, Transaction $transaction)
    {
        switch ($request->all()['type']) {
            case 'income':
                $request->merge(['title' => 'paiment reçu de vente ID: ' . $request->get('sale_id')]);
                break;

            case 'expense':
                $request->merge(['title' => 'frais et dépense de vente ID: ' . $request->all('sale_id')]);

                if ($request->get('amount') > 0) {
                    $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                }
                break;
        }

        $transaction->create($request->all());

        return redirect()
            ->route('sales.show', compact('sale'))
            ->withStatus('Successfully registered transaction.');
    }


    public function downloadPDF($id)
    {

        $sale = Sale::find($id);

        $total = 0;
        foreach ($sale->products as $product) {
            $total += $product->quantity * $product->price;
            //$sub_total=$sale->sum($total);
        }
        set_time_limit(0);
        $pdf = PDF::setPaper('a4', 'portrait')->loadView('sales.pdf', ["sale" => $sale,'total'=>$total])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('document.pdf');
    }


}
