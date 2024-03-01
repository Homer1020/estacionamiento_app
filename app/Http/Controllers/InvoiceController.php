<?php

namespace App\Http\Controllers;

use App\Models\Factura;

class InvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Factura $invoice)
    {
        return view('facturas.show', compact('invoice'));
    }
}
