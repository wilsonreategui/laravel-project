<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceDetailStoreRequest;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice) // Se actualiza a 'Invoice $invoice' para recibir el $invoice enviado desde el otro CONTROLLER
    {   
        $products = Product::all();
        $invoice_detail = InvoiceDetail::where('invoice_id', $invoice->id)->get();
        return view('invoices.detail', compact('invoice', 'products', 'invoice_detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceDetailStoreRequest $request)
    {
        $data = $request->all();
        
        $data['price'] = Product::find($data['product_id'])->price; 
        $data['total_product'] = $data['price'] * $data['quantity']; 

        InvoiceDetail::create($data);

        return redirect()->route('invoices.detail', ['invoice' => $data['invoice_id']])->with(['status' => 'success', 'message' => 'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceDetail $invoiceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceDetail  $invoiceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceDetail $invoiceDetail)
    {
        
    }

}
