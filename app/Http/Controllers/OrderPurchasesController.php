<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Salesfly\Salesfly\Repositories\OrderPurchaseRepo;
use Salesfly\Salesfly\Managers\OrderPurchaseManager;

use Salesfly\Salesfly\Repositories\DetailOrderPurchaseRepo;
use Salesfly\Salesfly\Managers\DetailOrderPurchaseManager; 

use Salesfly\Salesfly\Repositories\PendientAccountRepo;
use Salesfly\Salesfly\Managers\PendientAccountManager;

use Salesfly\Salesfly\Repositories\PaymentRepo;
use Salesfly\Salesfly\Managers\PaymentManager;

use Salesfly\Salesfly\Repositories\DetPaymentRepo;
use Salesfly\Salesfly\Managers\DetPaymentManager;
//use Intervention\Image\Facades\Image;

class OrderPurchasesController extends Controller {

    protected $orderPurchaseRepo;

    public function __construct(DetailOrderPurchaseRepo $detailOrderPurchaseRepo,DetPaymentRepo $detPaymentRepo,PaymentRepo $paymentRepo,PendientAccountRepo $pendientAccountRepo, OrderPurchaseRepo $orderPurchaseRepo)
    {
        $this->orderPurchaseRepo = $orderPurchaseRepo;
        $this->pendientAccountRepo=$pendientAccountRepo;
        $this->paymentRepo=$paymentRepo;
        $this->detPaymentRepo=$detPaymentRepo;
        $this->detailOrderPurchaseRepo=$detailOrderPurchaseRepo;
    }

    public function index()
    {
        return View('orderPurchases.index');
    }
  
    public function all($estado)
    {
        $orderPurchases = $this->orderPurchaseRepo->searchEstados($estado);
        return response()->json($orderPurchases);
        //var_dump($orderPurchases);
    }

    public function paginatep(){
        $orderPurchases = $this->orderPurchaseRepo->paginar();
        return response()->json($orderPurchases);
    }


    public function form_create()
    {
        return View('orderPurchases.form_create');
    }
    public function form_createP()
    {
        return View('orderPurchases.form_createP');
    }

    public function form_edit()
    {
        return View('orderPurchases.form_edit');
    }

    public function create(Request $request)
    {
        $orderPurchase = $this->orderPurchaseRepo->getModel();       
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10)) ){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();



        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres,'codigo'=>$orderPurchase->id,'warehouse_id'=>$orderPurchase->warehouses_id]);
    }

    public function find($id)
    {
        $orderPurchase = $this->orderPurchaseRepo->find($id);
        return response()->json($orderPurchase);
    }
    public function mostrarEmpresa($id){
    $orderPurchase=$this->orderPurchaseRepo->traerSumplier($id);
    return response()->json($orderPurchase);
    }

    public function edit(Request $request)
    {
       $orderPurchase = $this->orderPurchaseRepo->find($request->id);
       if($request->Estado == 0){
        $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista'));
        $manager->save();
    }else{
       $manager = new OrderPurchaseManager($orderPurchase,$request->except('fechaPedido','fechaPrevista','montoBruto','montoTotal','descuento'));
        $manager->save(); 
    }
       if($this->orderPurchaseRepo->validateDate(substr($request->input('fechaPedido'),0,10)) and $this->orderPurchaseRepo->validateDate(substr($request->input('fechaPrevista'),0,10))){
            $orderPurchase->fechaPedido = substr($request->input('fechaPedido'),0,10);
             $orderPurchase->fechaPrevista = substr($request->input('fechaPrevista'),0,10);
        }else{
           
            $orderPurchase->fechaPedido = null;
             $orderPurchase->fechaPrevista = null;
        }

        $orderPurchase->save();
        $verSiExiste=$this->detailOrderPurchaseRepo->Comprobar($request->id);

        $var=$request->detailOrderPurchases;//->except($request->detailOrderPurchases["id"]);
       //$orderPurchase = $this->orderPurchaseRepo->find($request->input('id'));
    if(!empty($verSiExiste[0])){
        //var_dump("no deve entrar");die();
       $orderPurchase->detPres()->detach();
       foreach($var as $object){
        $object["pendiente"]=0;
        $object["Cantidad_Ll"]=$object["cantidad"];
        $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
        $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
        $insertar->save();
        $detailOrderPurchaseRepox = null;

       }
   }else{
    foreach($var as $object){

           $detailOrderPurchaseRepox = new DetailOrderPurchaseRepo;
           $insertar=new DetailOrderPurchaseManager($detailOrderPurchaseRepox->getModel(),$object);
           $insertar->save();
           $detailOrderPurchaseRepox = null;

       }
   }
       //*************************************************************************************
           $verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
  //var_dump($verDeudas[0]->Saldo);die();
      $SaldoAfavor=$request->input('SaldoUtilizado');
      $provicional=null;
      if($verDeudas!=null){
        if($SaldoAfavor>0){
        foreach($verDeudas as $verDeudas){
         // $verDeudas=$this->pendientAccountRepo->verSaldos($request->input("supplier_id"));
          
         /* if($provicional==null){
              $payment = $this->paymentRepo->getModel();
              $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$verDeudas->Saldo]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=$request->input('MontoTotal')-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }*/
           if($verDeudas->Saldo>0 && $SaldoAfavor<=$verDeudas->Saldo){
              $var=$request->detPayments; 
              if($provicional==null){
              $payment = $this->paymentRepo->getModel();
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->find($provicional);
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);
              $payment=new PaymentManager($saldos,$request->all());
              $payment->save();
            }             
      // var_dump($var);die();
              $detPayment = $this->detPaymentRepo->getModel();
              $pendientAccountRepo = $this->pendientAccountRepo->getModel();
              $request->merge(['tipoPago'=>'A']);
              $request->merge(['payment_id'=>$provicional]);
              $request->merge(['montoPagado'=>$SaldoAfavor]);
              //$request->merge(['methodPayment_id'=>4]);
              $request->merge(['Saldo_F'=>$verDeudas->id]);
              $insertDetP = new DetPaymentManager($detPayment,$request->all());
              $insertDetP->save();
              $request->merge(['Saldo'=>$verDeudas->Saldo-$SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$verDeudas->orderPurchase_id]);
              $request->merge(['supplier_id'=>$verDeudas->supplier_id]);
              $updateSaldoF=new pendientAccountManager($verDeudas,$request->all());
              $updateSaldoF->save();
              break;
              //$SaldoAfavor=$verDeudas->Saldo-$request->input('SaldoUtilizado');
      }else{if($verDeudas->Saldo>0){
         $var=$request->detPayments;              
      // var_dump($var);die();
              $SaldoAfavor=$SaldoAfavor-$verDeudas->Saldo;
              if($provicional==null){
              $payment = $this->paymentRepo->getModel();
              //$request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=> $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);        
              $manager = new PaymentManager($payment,$request->all());
              $manager->save();
              $provicional=$payment->id;
            }else{
              $saldos = $this->paymentRepo->fine($provicional);
             // $request->merge(['MontoTotal'=>$montotot]);
              $request->merge(['Acuenta'=>$saldos->Acuenta+ $SaldoAfavor]);
              $request->merge(['orderPurchase_id'=>$request->input('id')]);
              $salc=floatval($request->input('MontoTotal'))-$request->input('Acuenta');
              $request->merge(['Saldo'=>$salc]);
              $payment=new PaymentManager($saldos,$request->all());
              $payment->save();
            }
              $detPayment = $this->detPaymentRepo->getModel();
              $pendientAccountRepo = $this->pendientAccountRepo->getModel();
              $request->merge(['tipoPago'=>'A']);
              $request->merge(['payment_id'=>$provicional]);
              $request->merge(['montoPagado'=>$verDeudas->Saldo]);
              $request->merge(['methodPayment_id'=>4]);
              $request->merge(['Saldo_F'=>$verDeudas->id]);
              $insertDetP = new DetPaymentManager($detPayment,$request->all());
              $insertDetP->save();
              
              $request->merge(['Saldo'=>0]);
              $request->merge(['orderPurchase_id'=>$verDeudas->orderPurchase_id]);
              $request->merge(['supplier_id'=>$verDeudas->supplier_id]);
              $updateSaldoF=new pendientAccountManager($verDeudas,$request->all());
              $updateSaldoF->save();
      }//fin else
     }//fin segundo if
    }//fin for
  }//fin primer if
}//fin if primeross
       //**************************************************************************************
        if($orderPurchase->Estado===2){
                   $payment1 = $this->paymentRepo->paymentById($request->input('id'));
                   $pendientAccount=$this->pendientAccountRepo->getModel();
                   //$pendientAcc=$this->pendientAccountRepo->verSaldos($payment1->id);
              if($payment1!=null){  
                  $detPayment=$this->detPaymentRepo->verPagosAdelantados($payment1->id); 
                if($detPayment!=null){
                  foreach($detPayment as  $detPayment) {
                     $SaldosTemporales =$this->pendientAccountRepo->find2($detPayment['Saldo_F']);
                     if($SaldosTemporales!=null){
                     $request->merge(['Saldo'=>$SaldosTemporales->Saldo+$detPayment['montoPagado']]);
                     $request->merge(['orderPurchase_id'=>$SaldosTemporales->orderPurchase_id]);
                     $request->merge(['supplier_id'=>$SaldosTemporales->supplier_id]);
                     $insercount=new PendientAccountManager($SaldosTemporales,$request->all());
                     $insercount->save();
                     }else{
                        $request->merge(['orderPurchase_id'=>$request->input('id')]);
                        $request->merge(['Saldo'=>$payment1->Acuenta]);
                        $insercount=new PendientAccountManager($pendientAccount,$request->all());
                        $insercount->save();
                     }
                  }
                  }else{   
                  $request->merge(['orderPurchase_id'=>$request->input('id')]);
                  $request->merge(['Saldo'=>$payment1->Acuenta]);
                  $insercount=new PendientAccountManager($pendientAccount,$request->all());
                  $insercount->save();
                  $provicional=$request->idpayment;
                }
        }
    }

        return response()->json(['estado'=>true, 'nombres'=>$orderPurchase->nombres]);
       
       
    }
    public function createDetalle()
    {
        return View('orderPurchases.form_createDetalle');
    }

    public function destroy(Request $request)
    {
        $orderPurchase= $this->orderPurchaseRepo->find($request->id);
        $orderPurchase->delete();
        return response()->json(['estado'=>true, 'nombre'=>$orderPurchase->nombre]);
    }

    public function search($q)
    {
        
        $orderPurchases = $this->orderPurchaseRepo->search($q);

        return response()->json($orderPurchases);
    }

}