@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                Comprobantes
            </h2>

            <a class="btn btn-default btn-lg btn-block" href="{{url('invoices/create')}}">Nuevo comprobante</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th style="width:150px;" class="text-right">IVA</th>
                        <th style="width:160px;" class="text-right">Sub Total</th>
                        <th style="width:160px;" class="text-right">Total</th>
                        <th style="width:180px;" class="text-right">Creado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model as $m)
                    <tr>
                        <td>
                            <a href="{{ url('invoices/detail/'.$m->id) }}">
                                {{ $m->client->name }}
                            </a>
                        </td>
                        <td class="text-right">Bs.S {{ number_format($m->iva, 2, ",", ".") }}</td>
                        <td class="text-right">Bs.S {{ number_format($m->subTotal, 2, ",", ".") }}</td>
                        <td class="text-right">Bs.S {{ number_format($m->total, 2, ",", ".") }}</td>
                        <td class="text-right">{{ $m->created_at->format('d-m-Y h:i A') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
