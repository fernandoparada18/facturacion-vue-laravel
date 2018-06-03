<template>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default">
					<div class="panel-body">
						<h2 class="page-header">
			                Nuevo comprobante
			            </h2>
					    <div class="well well-sm">
					        <div class="row">
					            <div class="col-xs-6">
					                <input id="client" class="form-control typeahead" type="text" placeholder="Cliente" />
					            </div>
					            <div class="col-xs-2">
					                <input class="form-control" type="text" placeholder="Dni" readonly v-model="fillClient.dni" />
					            </div>
					            <div class="col-xs-4">
					                <input class="form-control" type="text" placeholder="Dirección" readonly v-model="fillClient.address" />
					            </div>
					        </div>
					    </div>

					    <div class="row">
					        <div class="col-xs-7">
					            <input id="product" class="form-control" type="text" placeholder="Nombre del producto" />
					        </div>
					        <div class="col-xs-2">
					            <input id="quantity" class="form-control" type="text" placeholder="Cantidad" />
					        </div>
					        <div class="col-xs-2">
					            <div class="input-group">
					                <span class="input-group-addon" id="basic-addon">Bs.S</span>
					                <input class="form-control" type="text" placeholder="Precio" readonly />
					            </div>
					        </div>
					        <div class="col-xs-1">
					            <button class="btn btn-primary form-control" id="btn-agregar">
					                <i class="glyphicon glyphicon-plus"></i>
					            </button>
					        </div>
					    </div>

					    <hr />

					    <table class="table table-striped">
					        <thead>
					        <tr>
					            <th style="width:40px;"></th>
					            <th>Producto</th>
					            <th style="width:100px;">Cantidad</th>
					            <th style="width:100px;">P.U</th>
					            <th style="width:100px;">Total</th>
					        </tr>
					        </thead>
					        <tbody>
					        <tr>
					            <td>
					                <button class="btn btn-danger btn-xs btn-block">X</button>
					            </td>
					            <td></td>
					            <td class="text-right"></td>
					            <td class="text-right"></td>
					            <td class="text-right"></td>
					        </tr>
					        </tbody>
					        <tfoot>
					        <tr>
					            <td colspan="4" class="text-right"><b>IVA</b></td>
					            <td class="text-right"></td>
					        </tr>
					        <tr>
					            <td colspan="4" class="text-right"><b>Sub Total</b></td>
					            <td class="text-right"></td>
					        </tr>
					        <tr>
					            <td colspan="4" class="text-right"><b>Total</b></td>
					            <td class="text-right"></td>
					        </tr>
					        </tfoot>
					    </table>

					    <button class="btn btn-default btn-lg btn-block">
					        Guardar
					    </button>
					</div>
		    	</div>
	        </div>
	    </div>
	</div>
</template>

<script>
	import easy_autocomplete from 'easy-autocomplete'

	export default {
		data: function() {
            return {
                fillClient: {'id': 0, 'dni': '', 'address': ''},
            }
        },
        mounted: function() {
            this.clientAutocomplete();
        },
        methods: {
            clientAutocomplete: function(){
            	var self = this;
	            var client = $("#client"),
	                options = {
	                url: function(name) {
	                    return '/invoices/findClient?name=' + name;
	                },
	                getValue: 'name',
	                list: {
	                    onClickEvent: function() {
	                        var e = client.getSelectedItemData();
	                        self.fillClient.id = e.id;
	                        self.fillClient.dni = e.dni;
	                        self.fillClient.address = e.address;
	                    }
	                }
	            };

	            client.easyAutocomplete(options);
	        }
        }
    }
</script>