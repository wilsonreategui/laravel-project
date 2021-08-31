<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Mail\InvoiceMail;
use App\Models\Buyer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('buyer')->paginate();
        return view('invoices.index', compact('invoices'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        $buyers = Buyer::all();
        return view('invoices.create', compact('invoice', 'buyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request)
    {
        $data = $request->all();
        $data['status'] = 'Active'; // La columna 'status' por default será ""active"" y cuando finalice será ""complete""
        $invoice = Invoice::create($data);

        return redirect()->route('invoices.detail', ['invoice' => $invoice])->with(['status' => 'success', 'message' => 'Invoice created successfully']);
        //Redirigimos la página de la boleta hacia el detalle para agregar datos
        //Ruta inicializada en ROUTES (invoices.detail)
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return redirect()->route('invoices.detail', ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        
    }

    public function completeSend(Request $request, Invoice $invoice){

        /**Datos que irán al Mail */
        $details = InvoiceDetail::where('invoice_id', $invoice->id)->get();

        Mail::to( $invoice->buyer->email)
        ->queue(new InvoiceMail($invoice, $details));

        /**Cambiando estado de INVOICE a Complete */
        $invoice->status = 'Complete';
        $invoice->save();

        /**Redirigiendo a Index de Invoices */
        return redirect()->route('invoices.index')->with(['status' => 'success', 'message' => 'Invoice Completed and submitted successfully']);
    }
}
