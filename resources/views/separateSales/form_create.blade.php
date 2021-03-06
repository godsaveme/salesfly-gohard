 <section class="content-header"> 
          <h1>
            Crear PEDIDO/SEPARADO
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Ped/Sep</li>
            <li class="active">Crear</li>
          </ol>
 
          
        </section>

        <section class="content"> 
        <div class="row">
        <div class="col-md-12"> 

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Ped/Sep</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                  </div>






            <div class="nav-tabs-custom" id="myTabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Venta</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" ng-click="actualizarCaja()">Caja Venta</a></li>
                    <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false" ng-click="cargarVentasProduct()">Ventas Productos</a></li>

                    <!--<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Opciones</a></li>-->
                  
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    
                      <div class="row">
                      
                        <div class="col-md-3">

                            <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPedido.$error.required &amp;&amp; orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty &amp;&amp; orderPurchaseCreateForm.fechaPedido.$invalid]">
                                <label for="fechaPedido">Fecha Entrega: </label>
                            <div ng-hide="show" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control ng-pristine ng-valid ng-touched" name="fechaPedido" ng-model="sale.fechaEntrega">
                                </div>
                            <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty &amp;&amp; orderPurchaseCreateForm.fechaPedido.$invalid" class="ng-hide">
                            <span ng-show="orderPurchaseCreateForm.fechaPedido.$invalid" class="ng-hide"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                            </label>
                             
                             <div ng-show="show" class="input-group ng-hide">
                               <spam class="ng-binding"></spam>
                    </div> 
                      </div>  
                      
                    </div>
                          <div class="col-md-3">
                              <label for="">TIPO:</label>
                              <select class="form-control" name="" id="" ng-model="sale.tipo" ng-change="borraCompras()">
                                  <option value="1">SEPARADO</option>
                                  <option value="2">PEDIDO</option>
                              </select>
                          </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6" >
                      <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #D7EAE3; border-style: solid;
                              border-width: 2px; border-color: #C8D9F7; border-radius: 10px 10px 0px 0px;">
                          <div class="row">
                            <div class="col-md-9" ng-show="skuestado">
                              <input type="text" ng-model="varianteSkuSelected" placeholder="Buscar por SKU" ng-enter="getvariantSKU()" class="form-control">
                            </div>

                            <div class="col-md-9" ng-show="!skuestado">
                              <input  type="text" ng-model="atributoSelected" ng-enter="open()" placeholder="Buscar por codigo" typeahead="atributo as atributo.NombreAtributos for atributo in getAtributos($viewValue)" 
                                    typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                            </div>
                            <div class="col-md-3" >
                            <div class="form-group">
                                <input type="checkbox" name="estado" ng-model="base" ng-checked="base" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                                <label for="estado">Base</label>                             
                              
                                <input type="checkbox" name="skuestado" ng-model="skuestado" ng-checked="skuestado" class="ng-valid ng-dirty ng-valid-parse ng-touched">
                                <label for="estado">SKU</label>                             
                              </div>
                            </div>

                            
                            
                            
     
                           </div>
 
                        </div><!-- /.box-header -->
                        <div class="box-body" style="min-height: 400px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7;" >
                          <table class="table table-bordered">
                                             
                            <tr ng-repeat="row in compras track by $index">
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover.templateUrl" type="button" class="btn btn-default">@{{compras[$index].cantidad}}</button>
                              </td>
                              <td><a popover-template="dynamicPopover5.templateUrl" popover-trigger="mouseenter">@{{compras[$index].NombreAtributos}}</a></td>
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover1.templateUrl" type="button" class="btn btn-default">@{{compras[$index].precioVenta| number:2}}</button>
                              </td>
                              <td>@{{compras[$index].subTotal | number:2}}</td>
                              <td><button type="button" class="btn btn-danger ng-binding"  ng-click="sacarRow($index,row.subTotal)">
                              <span class="glyphicon glyphicon-trash"></span>
                              </td>                    
                            </tr>                                    
                          </table>
    
                        </div><!-- /.box-body -->


                        <div class="box-footer clearfix" style="background-color: #D7EAE3; border-style: solid;
                               border-width: 2px; border-color: #C8D9F7; border-radius: 0px 0px 10px 10px;">
                          <div class="row">
                            <div class="col-md-6" >
                              <table class="table table-bordered">
                                <tr>
                                  <div class="row">
                                    <div class="col-md-10" >
                                      <input type="text" ng-model="customersSelected" placeholder="Buscar Cliente" typeahead="atributo as atributo.busqueda for atributo in getcustomers($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control" typeahead-on-select="selecionarCliente()"/>
                                    </div>
                                    <div>
                                      <a class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana2"><span class="glyphicon glyphicon-plus"></span></a>
                                    </div>
                                </tr>
                                <tr>
                                  <div>
                                    <a ng-if="sale.cliente!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteCliente()"></a>
                                    @{{sale.cliente!=undefined? sale.cliente:'--No hay cliente seleccionado--'}}
                                  </div>
                                </tr> 
                                <tr>
                                  <div>
                                    <input type="text" ng-model="employeeSelected" placeholder="Buscar Vendedor" typeahead="atributo as atributo.busqueda for atributo in getemployee($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control" typeahead-on-select="selecionarVendedor()"/>
                                  </div>
                                </tr>
                               <tr>
                                  <div>
                                    <a ng-if="sale.vendedor!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteVendedor()"></a>
                                    @{{sale.vendedor!=undefined? sale.vendedor:'--No hay vendedor seleccionado--'}}
                                  </div>
                                </tr>
                                <tr>
                                  <div class="row">
                                    <div class="col-md-7" >
                                      <button ng-click="estadoNotas()" ng-if="banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-default">ADD NOTAS</a>
                                      <button ng-click="estadoNotas()" ng-if="!banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-danger">ADD NOTAS</a>
                                      
                                    
                                    </div>
                                    <div class="col-md-5" >
                                      <a ng-if="sale.montoTotal>0 && sale.fechaEntrega!=undefined" class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana1" ng-click="pagar()">PAGAR</a>
                                      <a ng-if="sale.montoTotal==0 || sale.fechaEntrega==undefined"class="btn btn-default ng-binding" ng-click="pagar()">PAGAR</a>
                                    </div>
                                  </div>
                                </tr>
                                  
                              </table>

                            </div>

                            <div class="col-md-6" >
                                <table class="table table-bordered">
                                <tr>
                                <td>Sub Total</td>
                                <td>@{{sale.montoBruto | number:2}}</td>                    
                                </tr>
                                <tr> 
                                <td>IGV</td>
                                <td>@{{sale.igv | number:2}}</td>                    
                                </tr> 
                                <tr style="border-bottom: solid; border-width: medium;">
                                <td>Descuento</td>
                                <td>
                                  <button popover-template="dynamicPopover2.templateUrl" type="button" class="btn btn-default">@{{sale.descuento | number:2}}</button>
                                </td>                    
                                </tr> 
                                <tr>
                                <td ><b>Total</b></td>
                                <td ng-model="sale.montoTotal" ><b>@{{sale.montoTotal | number:2}}</b></td>                    
                                </tr>                                   
                              </table>
                            </div>
                        </div>
                      </div> 

                    </div>





                    </div>

                    <div class="col-md-6" style="min-height: 670px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7; border-radius:10px" >
                       <!-- Parte de Favorito-->
                      
                    </div>
                  </div>

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Usuario</th>
                        <th>Documento</th>
                      
                      <th>S/.Tarjeta</th>
                      <th>S/.Efectivo</th>
                        <th>Tipo</th>
                      <th>Estado</th>
                      <th>Ver Venta</th>
                    </tr>
                    
                    <tr ng-repeat="row in detCashes">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.hora}}</td>
                      <td>@{{row.name}}</td>
                      <td ng-if="row.NumDocument!=null">@{{ row.NumDocument }}</td>
                        <td ng-if="row.NumDocument==null">-</td>
                      <td>@{{row.tarjeta}}</td>
                      <td>@{{row.efectivo}}</td>

                        <td ng-if="row.tipo==1">Separ.</td>
                        <td ng-if="row.tipo==2">Pedid.</td>

                        <td ng-if="row.estado==1"><span style="color: yellow;">Pag. sin entre.</span></td>
                        <td ng-if="row.estado==0"><span style="color: cornflowerblue;">Pend. sin entre.</span></td>
                        <td ng-if="row.estado==2"><span style="color: green;">Pag y entre.</span></td>
                        <td ng-if="row.estado==3"><span style="color: red;">Anulado</span></td>
                      
                      <td ><a href="/separateSales/edit/@{{row.id}}" target="_blank">Ver</a></td>

                    </tr>                   
                  </table>
                  <div class="box-footer clearfix">
                    <pagination total-items="totalItems1" ng-model="currentPage1" max-size="maxSize1" 
                    class="pagination-sm no-margin pull-right" items-per-page="itemsperPage1" boundary-links="true" rotate="false" 
                    num-pages="numPages1" ng-change="pageChanged1()"></pagination>
                  </div>                    

                  </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_6">


              
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Marca</th>
                                <th>Codigo</th>
                                <th>sku</th>
                                <th>Cantidad</th>
                                <th>Línea</th>
                                <th>Estacion</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Taco</th>
                                <th>Talla</th>
                                <th>Separado/Pedido</th>
                                <th>Pagos (A/S)</th>
                                <th>Modo de Pago</th>
                                <th>Monto</th>
                            </tr>

                            <tr  ng-repeat="row in ventas track by $index">
                                <td>@{{$index + 1}}</td>
                                <td>@{{row.marca}}</td>
                                <td>@{{row.codigo}}</td>
                                <td>@{{row.sku}}</td>
                                <td>@{{row.cantidad | number:0}}</td>
                                <td>@{{row.linea}}</td>
                                <td>@{{row.estacion}}</td>
                                <td>@{{row.modelo}}</td>
                                <td>@{{row.color}}</td>
                                <td>@{{row.Taco}}</td>
                                <td>@{{row.Talla}}</td>
                                <td ng-if="row.tipo==1">SEPARADO</td>
                                <td ng-if="row.tipo==2">PEDIDO</td>
                                <td>S/. @{{ row.acuenta }} - @{{ row.saldo }}</td>
                                <td>@{{row.SMPNombre}}</td>

                                <td ng-if="row.estado==0" style="color: cornflowerblue;">S/. @{{row.subTotal}}</td>
                                <td ng-if="row.estado==1" style="color: yellow;">S/. @{{row.subTotal}}</td>
                                <td ng-if="row.estado==2" style="color: green;">S/. @{{row.subTotal}}</td>
                                <td ng-if="row.estado==3" style="color: red;">S/. @{{row.subTotal}}</td>
                            </tr>


                        </table>
                        <div class="box-footer clearfix">
                            <pagination total-items="totalItemsV" ng-model="currentPageV" max-size="maxSizeV" class="pagination-sm no-margin pull-right"
                                        items-per-page="itemsperPageV" boundary-links="true" rotate="false" num-pages="numPages" ng-change="pageChangedV()"></pagination>
                        </div>
                    </div>

                  <div class="tab-pane" id="tab_3">
                  <div class="row">
                    <div class="col-md-4">
                     <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select ng-click="mostrarAlmacenCaja()" class="form-control" name="" ng-model="store.id" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                        <label for="year">Almacen</label>
                        <select class="form-control" name="" ng-model="warehouse.id" ng-options="item.id as item.nombre for item in warehouses" ng-click="cargarAtributos()">
                          <option value="">--Elije Almacen--</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Caja</label>

                          <select class="form-control" name="" ng-model="cash1.cashHeader_id" ng-options="item.id as item.nombre for item in cashHeaders">
                          <option value="">--Elije Caja--</option>
                          </select>
                        </div>
                      </div>

                    </div>


                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
               <script type="text/javascript">$('#myTabs a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')})
              </script>



                  



                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
            
              </section><!-- /.content -->


      <script type="text/ng-template" id="myPopoverTemplate6.html">
        <div class="form-group">
          <label>@{{dynamicPopover6.title}}</label>
          <div class="row" >
          <div class="col-md-12">
            <textarea  ng-model="sale.notas" type="text"  class="form-control"/>
           </div> 
          </div>
        </div>
    </script>




    <script type="text/ng-template" id="myPopoverTemplate.html">
        <div class="form-group">
          <label>@{{dynamicPopover.title}}</label>
          <div class="row" >
          <div class="col-md-9">
            <input type="number" min="0"ng-model="compras[$index].cantidad" ng-change="calcularmontos($index)" class="form-control">
            </div>
            <button type="button" class="btn btn-xs" ng-click="aumentarCantidad($index)">
            <span type="button" class="glyphicon glyphicon-plus"></span></button>
            <button type="button" class="btn btn-xs" ng-click="disminuirCantidad($index)">
            <span type="button" class="glyphicon glyphicon-minus"></span></button>

          </div>
        </div>
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate1.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover1.title1}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" ng-model="compras[$index].descuento" ng-change="keyUpDescuento($index)"class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuento($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuento($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Precio Unidad"><div class="form-group">
            <label>@{{dynamicPopover1.title}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" min="0" ng-change="calcularmontos($index)" ng-model="compras[$index].precioVenta" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarPrecio($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirPrecio($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate2.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover2.title1}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" ng-model="sale.descuento" ng-change="keyUpDescuentoPedido()" class="form-control"></input>
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuentoPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuentoPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Total"><div class="form-group">
            <label>@{{dynamicPopover2.title}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" min="0" ng-model="sale.montoTotal" ng-change="keyUpTotalPedido()" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarTotalPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirTotalPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>

    <script type="text/ng-template" id="myPopoverTemplate5.html">
      <div class="form-group">
          <label>@{{dynamicPopover5.title}}</label>
        </div>

        <div>
        <label>Stock : </label>
        <label>@{{compras[$index].Stock}}</label>
        </div>

        <div>
        <label>Pedidos : </label>
        <label>@{{compras[$index].stockPedidos}}</label>
        </div>

        <div>
        <label>Separados : </label>
        <label>@{{compras[$index].stockSeparados}}</label>
        </div>

        <div>
        <label>precio : </label>
        <label>@{{compras[$index].precioProducto}}</label>
        </div>


          
                 
    </script>


    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Presentaciones</h3>
        </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Presentacion</th>
                      <th>Equivalencia</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in presentations">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.NombreAtributos}}</td>
                      <td>@{{row.precioProducto}}</td> 
                      <td>@{{row.Presentacion}}</td>  
                      <td>@{{row.equivalencia}} @{{row.nomBase}}</td>
                      <td ng-if="row.base==0"><span class="badge bg-red">NO</span></td> 
                      <td ng-if="row.base!=0"><span class="badge bg-green">SI</span></td> 
                      <td><a ng-click="AsignarCompra(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>                                       
                  </table>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>


    <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Opciones Año</h4>
                        </div>
                        <form name="customerCreateForm" role="form" novalidate> 
                        <!--=================cueropo========================-->
                        <div class="modal-body">
                   <div class="row" >
                    <div class="col-md-6">
                      <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.nombres.$error.required && customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="customer.nombres" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid">
                        <span ng-show="customerCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.apellidos.$error.required && customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="customer.apellidos" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid">

                        <span ng-show="customerCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    </div>
                    </div>

                    <div class="row" >
                    <div class="col-md-6">
                    <div class="form-group" >
                      <label for="apellidos">Empresa / Razón Social</label>
                      <input type="text" class="form-control" name="empresa" placeholder="empresa"
                      ng-model="customer.empresa">
                     </div>
                     </div>
                     <div class="col-md-6">
                    <div class="form-group" >
                      <label for="direccFiscal">Dirección Fiscal</label>
                      <input type="text" class="form-control" name="direccFiscal" placeholder="dirección fiscal"
                      ng-model="customer.direccFiscal">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                    <div class="col-md-6"> 
                    <div class="form-group" >
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="customer.ruc" ng-change="ValidarCamposRuc()">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                        <div class="form-group" >
                                      <label for="codigo">Código de Cliente</label>
                                      <input type="text" class="form-control" name="codigo" placeholder="codigo de cliente"
                                             ng-model="customer.codigo" ng-disabled="customer.autogenerado" ng-required="!customer.autogenerado">
                                      <span style="color:#dd4b39;" ng-show="customerCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                  </div>
                      </div>

                        <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="apellidos">Autogenerado</label><br>
                                      <input type="checkbox" ng-model="customer.autogenerado"> Cód. gen.
                                  </div>
                              </div>
                    </div>
                    <div class="row" >
                    <div class="col-md-5"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.fechaNac.$error.required && customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid]">
                    <label for="fechaNac">Fecha de Nac.</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechaNac" ng-model="customer.fechaNac">
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid">
                                              <span ng-show="customerCreateForm.fechaNac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                     </div>
                     </div>
                     <div class="col-md-3"> 
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="customer.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                      </div>
                      <div class="col-md-4">
            <div class="form-group" >
                <label for="dni">DNI</label>
                <input type="text" class="form-control" name="dni" placeholder="8 dígitos"
                       ng-model="customer.dni" ng-change="ValidarCamposDni()">
            </div>
        </div>
                     </div>


                     <div class="">
                          <hr>
                          <button type="button" class="btn btn-default" ng-click="toggle()">Mostrar Formulario de Contacto</button>
                          <hr>
                      </div>

                <div ng-show="show" >
                     <div class="row" >
                     

                    <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="fijo">Teléfono fijo</label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="customer.fijo">
                     </div>
                     </div>

                     <div class="col-md-4"> 
                    <div class="form-group" >
                      <label for="movil">Teléfono movil</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="customer.movil">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="###"
                      ng-model="customer.email">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="website">Página Web</label>
                      <input type="text" class="form-control" name="website" placeholder="###"
                      ng-model="customer.website">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="direccContac">Dirección de Contacto</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="###"
                      ng-model="customer.direccContac">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="distrito">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Chiclayo"
                      ng-model="customer.distrito">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="provincia">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Chiclayo"
                      ng-model="customer.provincia">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="departamento">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Lambayeque"
                      ng-model="customer.departamento">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="pais">País</label>
                      <input type="text" class="form-control" name="pais" placeholder="Perú"
                      ng-model="customer.pais">
                     </div>
                     </div>
                     </div>
                    <div class="form-group" >
                      <label for="notas">Notas</label>
                      <input type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="customer.notas"></input>
                     </div>
                      </div>
                  </div>
                        <!--================================================-->
                        <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="createCustomer()">Crear</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>


          <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header" style="background-color: #0673B3; border-radius: 5px; color: #E2E2EC;">
                    
                          <h4 class="modal-title">Realizar Pago</h4>
                        </div>
                        <!--=================cueropo========================-->
                <div class="modal-body">
              <div class="row" >
                <div class="col-md-5"> 
                  <table class="table table-bordered">
                    <tr>
                      <td>Cash</td>
                      <td>
                        <input type="number" min="0.00"class="form-control" name="cash" placeholder=""
                          ng-model="pago.cash" ng-change="calcularVuelto()"></input>
                      </td>                    
                    </tr>
                    <tr>

                      <td>Tarjeta</td>
                      <td><input type="number" min="0.00"class="form-control" name="tarjeta" placeholder=""
                          ng-model="pago.tarjeta" ng-change="calcularVuelto()"></input>
                      </td>
                    </tr>
                    <tr> 
                      <td>
                          <a class="btn btn-success btn-xs" ng-click="limpiartipoTarjeta()">Clear</a>   
                      </td>
                      <td>
                        <div class="btn-group">
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'2'">Visa</label>
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'3'">MasterCard</label>
                        </div>  
                      </td>                    
                    </tr>                                    
                    <tr>
                      <td></td>
                      <td>
                        <div class="form-group">
                          <input type="checkbox" name="estado" ng-model="acuenta" ng-checked="acuenta" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                          <label for="estado">Acuenta</label>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div>
                  <div class="col-md-7">
                    <table class="table table-bordered">
                      <tr>
                        <td>Sub Total</td>
                        <td style="font-size:150%;">S/. @{{sale.montoBruto | number:2}}</td>                    
                      </tr>
                      <tr> 
                        <td>IGV</td>
                        <td style="font-size:150%;">S/. @{{sale.igv | number:2}}</td>                    
                      </tr>
                      <tr style="border-bottom: solid; border-width: medium;">
                        <td>Descuento</td>
                        <td style="font-size:150%;">S/. @{{sale.descuento | number:2}}</td>
                      </tr>  
                      <tr>
                        <td><b>Total Pagar</b></td>
                        <td><b  style="font-size:150%;">S/. @{{sale.montoTotal | number:2}}</b></td>                    
                      </tr> 
                      <tr>
                        <td><b>Vuelto</b></td>
                        <td><b style="font-size:150%;">S/. @{{sale.vuelto | number:2}}</b></td>                    
                      </tr>                                   
                    </table>

                </div>
                </div>
                   
                </div>

                        <!--================================================-->
                        <div class="modal-footer" >
                          <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="realizarPago()">Cobrar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>