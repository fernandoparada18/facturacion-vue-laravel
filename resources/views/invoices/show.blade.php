@extends('layouts.app')

@section('content')
    <div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default">
					<div class="panel-body">
						<h2 class="page-header">
			                Comprobante # {{ str_pad($model->id, 7, 0, STR_PAD_LEFT) }}
			            </h2>
					    <div class="well well-sm">
					        <div class="row">
					            <div class="col-xs-4">
					                <input class="form-control typeahead" type="text" readonly value="{{ $model->client->name }}" />
					            </div>
					            <div class="col-xs-2">
					                <input class="form-control" type="text" readonly value="{{ $model->client->dni }}" />
					            </div>
					            <div class="col-xs-6">
					                <input class="form-control" type="text" readonly value="{{ $model->client->address }}" />
					            </div>
					        </div>
					    </div>

					    <hr />

					    <table class="table table-striped">
					        <thead>
					        <tr>
					            <th>Producto</th>
					            <th style="width:100px;" class="text-center">Cantidad</th>
					            <th style="width:110px;" class="text-center">P.U</th>
					            <th style="width:120px;" class="text-center">Total</th>
					        </tr>
					        </thead>
					        <tbody>
					        @foreach($model->details as $d)
					        <tr>
					            <td>{{ $d->product->name }}</td>
					            <td class="text-center">{{ $d->quantity }}</td>
					            <td class="text-right">Bs.S {{ number_format($d->unitPrice, 2, ",", ".") }}</td>
					            <td class="text-right">Bs.S {{ number_format($d->total, 2, ",", ".") }}</td>
					        </tr>
					        @endforeach
					        </tbody>
					        <tfoot>
					        <tr>
					            <td colspan="3" class="text-right"><b>IVA</b></td>
					            <td class="text-right">Bs.S {{ number_format($model->iva, 2, ",", ".") }}</td>
					        </tr>
					        <tr>
					            <td colspan="3" class="text-right"><b>Sub Total</b></td>
					            <td class="text-right">Bs.S {{ number_format($model->subTotal, 2, ",", ".") }}</td>
					        </tr>
					        <tr>
					            <td colspan="3" class="text-right"><b>Total</b></td>
					            <td class="text-right">Bs.S {{ number_format($model->total, 2, ",", ".") }}</td>
					        </tr>
					        </tfoot>
					    </table>
					</div>
		    	</div>
	        </div>
	    </div>
	</div>
@endsection
