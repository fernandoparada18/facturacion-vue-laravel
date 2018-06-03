<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ClientRepository;

class InvoiceController extends Controller
{
	private $_client;

	public function __construct(
		ClientRepository $client
	){
		$this->_client = $client;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.index' );
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

    public function findClient(Request $request)
    {
        return $this->_client->findByName($request->input('name'));
    }
}
