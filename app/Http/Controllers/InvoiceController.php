<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PDF;
class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);

        return view('frontend.index', compact('invoices'));
    }


    public function create()
    {
        //
        return view('frontend.create');
    }



    public function store(Request $request)
    {
        //
        $invoice = Invoice::create($request->all());

        $details_list = [];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $details_list[$i]['product_name'] = $request->product_name[$i];
            $details_list[$i]['unit'] = $request->unit[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }

        $details = $invoice->details()->createMany($details_list);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.created_successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.created_failed'),
                'alert-type' => 'danger'
            ]);
        }

    }


    public function show($id)
    {
        //
        $invoice = Invoice::findOrFail($id);
        return view('frontend.show', compact('invoice'));
    }


    public function edit($id)
    {
        //
        $invoice = Invoice::findOrFail($id);
        return view('frontend.edit', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        //
        $invoice = Invoice::findOrFail($id);

        $invoice->update($request->all());

        $invoice->details()->delete();


        $details_list = [];
        for ($i = 0; $i < count($request->product_name); $i++) {
            $details_list[$i]['product_name'] = $request->product_name[$i];
            $details_list[$i]['unit'] = $request->unit[$i];
            $details_list[$i]['quantity'] = $request->quantity[$i];
            $details_list[$i]['unit_price'] = $request->unit_price[$i];
            $details_list[$i]['row_sub_total'] = $request->row_sub_total[$i];
        }

        $details = $invoice->details()->createMany($details_list);

        if ($details) {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.updated_successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/frontend.updated_failed'),
                'alert-type' => 'danger'
            ]);
        }
    }


    public function destroy($id)
    {
        //
        $invoice = Invoice::findOrFail($id);
        if ($invoice) {
            $invoice->delete();
            return redirect()->route('invoice.index')->with([
                'message' => __('Frontend/frontend.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->route('invoice.index')->with([
                'message' => __('Frontend/frontend.deleted_failed'),
                'alert-type' => 'danger'
            ]);
        }
    }


    public function print($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('frontend.print', compact('invoice'));
    }


    public function pdf($id)
    {
        $invoice = Invoice::findOrFail($id);

        $data['invoice_id']         = $invoice->id;
        $data['invoice_date']       = $invoice->invoice_date;
        $data['customer']           = [
            __('Frontend/frontend.customer_name')       => $invoice->customer_name,
            __('Frontend/frontend.customer_mobile')     => $invoice->customer_mobile,
            __('Frontend/frontend.customer_email')      => $invoice->customer_email
        ];
        $items = [];
        $invoice_details            =  $invoice->details()->get();
        foreach ($invoice_details as $item) {
            $items[] = [
                'product_name'      => $item->product_name,
                'unit'              => $item->unitText(),
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'row_sub_total'     => $item->row_sub_total,
            ];
        }

        $data['items'] = $items;

        $data['invoice_number']     = $invoice->invoice_number;
        $data['created_at']         = $invoice->created_at->format('Y-m-d');
        $data['sub_total']          = $invoice->sub_total;
        $data['discount']           = $invoice->discountResult();
        $data['vat_value']          = $invoice->vat_value;
        $data['shipping']           = $invoice->shipping;
        $data['total_due']          = $invoice->total_due;


        $pdf = PDF::loadView('frontend.pdf', $data);
        return $pdf->stream($invoice->invoice_number.'.pdf');

    }

}
