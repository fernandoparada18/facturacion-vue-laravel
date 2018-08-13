<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Repositories\InvoiceRepository;
use PDF;

class InvoiceController extends Controller
{
	private $_client;
	private $_product;
    private $_invoice;

	public function __construct(
		ClientRepository $client,
		ProductRepository $product,
        InvoiceRepository $invoice
	){
        $this->middleware('auth');
		$this->_client = $client;
		$this->_product = $product;
        $this->_invoice = $invoice;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'invoices.index', [
                'model' => $this->_invoice->getAll()
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('invoices.show', [
                'model' => $this->_invoice->get($id)
            ]
        );
    }

    public function pdf($id)
    {
        $model = $this->_invoice->get($id);
        $invoice_name = sprintf('comprobante-%s.pdf', str_pad($model->id, 7, '0', STR_PAD_LEFT));
        $pdf = PDF::loadView('invoices.pdf', [
            'model' => $model
        ]);

        return $pdf->download($invoice_name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object)[
            'iva' => $request->input('iva'),
            'subTotal' => $request->input('subTotal'),
            'total' => $request->input('total'),
            'client_id' => $request->input('client_id'),
            'details' => []
        ];

        foreach ($request->input('details') as $d) {
            $data->details[] = (object)[
                'product_id' => $d['id'],
                'quantity'   => $d['quantity'],
                'unitPrice'  => $d['price'],
                'total'      => $d['total']
            ];
        }

        return $this->_invoice->save($data);
    }

    public function findClient(Request $request)
    {
        return $this->_client->findByName($request->input('name'));
    }

    public function findProduct(Request $request)
    {
        return $this->_product->findByName($request->input('name'));
    }
}
