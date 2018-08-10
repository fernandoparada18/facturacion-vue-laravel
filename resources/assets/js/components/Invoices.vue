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
					            <input id="product" class="form-control" type="text" placeholder="Nombre del producto" v-model="fillProduct.name"/>
					        </div>
					        <div class="col-xs-2">
					            <input class="form-control" type="text" placeholder="Cantidad" v-model="fillProduct.quantity"/>
					        </div>
					        <div class="col-xs-2">
					            <div class="input-group">
					                <span class="input-group-addon" id="basic-addon">Bs.S</span>
					                <input class="form-control" type="text" placeholder="Precio" v-model="fillProduct.price" readonly />
					            </div>
					        </div>
					        <div class="col-xs-1">
					            <button class="btn btn-primary form-control" v-on:click.prevent="addProductToDetail()">
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
					            <th style="width:110px;">P.U</th>
					            <th style="width:120px;">Total</th>
					        </tr>
					        </thead>
					        <tbody>
					        <tr v-for="detail in details">
					            <td>
					                <button class="btn btn-danger btn-xs btn-block" v-on:click.prevent="removeProductFromDetail(detail)">X</button>
					            </td>
					            <td>{{ detail.name }}</td>
					            <td class="text-center">{{ detail.quantity }}</td>
					            <td class="text-right">Bs.S {{ detail.price }}</td>
					            <td class="text-right">Bs.S {{ detail.total.toFixed(2) }}</td>
					        </tr>
					        </tbody>
					        <tfoot>
					        <tr>
					            <td colspan="4" class="text-right"><b>IVA</b></td>
					            <td class="text-right">Bs.S {{ iva.toFixed(2) }}</td>
					        </tr>
					        <tr>
					            <td colspan="4" class="text-right"><b>Sub Total</b></td>
					            <td class="text-right">Bs.S {{ subTotal.toFixed(2) }}</td>
					        </tr>
					        <tr>
					            <td colspan="4" class="text-right"><b>Total</b></td>
					            <td class="text-right">Bs.S {{ total.toFixed(2) }}</td>
					        </tr>
					        </tfoot>
					    </table>

					    <button v-if="details.length > 0 && fillClient.id > 0" v-on:click.prevent="save" class="btn btn-default btn-lg btn-block">
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
                fillProduct: {'id': 0, 'name': '', 'quantity': '', 'price': ''},
                details: [],
        		iva: 0,
        		subTotal: 0,
        		total: 0,
            }
        },
        mounted: function() {
            this.clientAutocomplete();
            this.productAutocomplete();
        },
        methods: {
        	removeProductFromDetail: function(item) {
	            var index = this.details.indexOf(item);
	            this.details.splice(index, 1);
	            this.calculate();
	        },
        	addProductToDetail: function() {
	            this.details.push({
	                id: this.fillProduct.id,
	                name: this.fillProduct.name,
	                quantity: parseFloat(this.fillProduct.quantity),
	                price: parseFloat(this.fillProduct.price),
	                total: parseFloat(this.fillProduct.price * this.fillProduct.quantity)
	            });

	            this.fillProduct = {'id': 0, 'name': '', 'quantity': '', 'price': ''};

	            this.calculate();
	        },
	        save: function() {
	        	var url = '/invoices/save';
	            axios.post(url, { 
	            	iva: this.iva, 
	            	subTotal: this.subTotal, 
	            	total: this.total, 
	            	client_id: this.fillClient.id, 
	            	details: this.details
	            }).then(r => {
	                if (r.data.response) {
	                	window.location.href = '/invoices';
	                }else{
	                	alert('Ocurrio un error...!!!');
	                }
	            });
	        },
	        calculate: function() {
	            var total = 0;

	            this.details.forEach(function(e){
	                total += e.total;
	            });

	            this.total = total;
	            this.subTotal = parseFloat(total / 1.12);
	            this.iva = parseFloat(total - this.subTotal);
	        },
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
	        },
	        productAutocomplete: function(){
	        	var self = this;
	            var product = $("#product"),
	                options = {
	                url: function(name) {
	                    return '/invoices/findProduct?name=' + name;
	                },
	                getValue: 'name',
	                list: {
	                    onClickEvent: function() {
	                        var e = product.getSelectedItemData();
	                        self.fillProduct.id = e.id;
	                        self.fillProduct.name = e.name;
	                        self.fillProduct.price = e.price;
	                    }
	                }
	            };

	            product.easyAutocomplete(options);
	        }
        }
    }
</script>