<!DOCTYPE html>
<html>
<head>
	<style>
		body{font-family: Tahoma;}
		table{width: 100%;}
		.text-right{text-align: right;}
		h1 small{display: block;font-size: 20px;color: #4d4d4d;}
	</style>
</head>
<body>

	<h1>
		Comprobante # {{ str_pad($model->id, 7, 0, STR_PAD_LEFT) }}
		<small>Emitido el {{ $model->created_at }}</small>
	</h1>
	
	<table>
		<tr>
			<th style="width:100px;">
				Cliente
			</th>
			<td>{{ $model->client->name }}</td>
		</tr>
		<tr>
			<th style="width:100px;">
				Cliente
			</th>
			<td>{{ $model->client->dni }}</td>
		</tr>
		<tr>
			<th style="width:100px;">
				Cliente
			</th>
			<td>{{ $model->client->address }}</td>
		</tr>
	</table>

    <hr />

    <table>
        <thead>
        <tr>
            <th>Producto</th>
            <th style="width:100px;">Cantidad</th>
            <th style="width:110px;">P.U</th>
            <th style="width:120px;">Total</th>
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
</body>
</html>
		
