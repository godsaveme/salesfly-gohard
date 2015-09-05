<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Mockery\Matcher\Type;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\VariantRepo;
use Salesfly\Salesfly\Managers\VariantManager;

use Salesfly\Salesfly\Entities\Variant;
use Salesfly\Salesfly\Entities\Product;

use Salesfly\Salesfly\Repositories\DetPresRepo;
use Salesfly\Salesfly\Managers\DetPresManager;

use Salesfly\Salesfly\Repositories\AtributRepo;
use Salesfly\Salesfly\Managers\AtributManager;

use Salesfly\Salesfly\Repositories\DetAtrRepo;
use Salesfly\Salesfly\Managers\DetAtrManager;

use Salesfly\Salesfly\Repositories\StockRepo;
use Salesfly\Salesfly\Managers\StockManager;

class VariantsController extends Controller
{
    protected $variantRepo;

    public function __construct(VariantRepo $variantRepo)
    {
        $this->variantRepo = $variantRepo;
    }

    public function index()
    {
        return View('products.index');
    }

    public function find($id)
    {
        $variants = $this->variantRepo->find($id);
        //var_dump($variants);die();
        return response()->json($variants);
    }
    public function autocomplit($sku){
        $variants = $this->variantRepo->uatocomplit($sku);
        return response()->json($variants);
        
    }

    public function paginatep($id,$var){ //->with(['store'])
        $variants = $this->variantRepo->selectByID($id,$var);
        return response()->json($variants);
    }


    public function form_create()
    {
        //$product = Product::find($product_id);
        return View('variants.form_create');
    }

    public function form_edit()
    {
        return View('variants.form_edit');
    }

    public function create(Request $request)
    {
        //var_dump($request->all()); die();

        $oProd = Product::find($request->input('product_id'));

            //si viene el prod y ademas es prod con variantes
        if(!empty($oProd) && $oProd->hasVariants == 1){


        $variant = $this->variantRepo->getModel();

        $managerVar = new VariantManager($variant,$request->except('stock','detAtr','presentation_base_object','presentations'));
        $managerVar->save();

            $oProd->quantVar = $oProd->quantVar + 1;
            $oProd->save();


            //================================ VARIANTES==============================//


            foreach($request->input('presentations') as $presentation){
                $presentation['variant_id'] = $variant->id;
                $presentation['presentation_id'] =  $presentation['id'];
                $oPres = new DetPresRepo();
                $presManager = new DetPresManager($oPres->getModel(),$presentation);
                $presManager->save();
            }

            foreach($request->input('detAtr') as $detAtr){
                if(!empty($detAtr['descripcion'])){
                    $detAtr['variant_id'] = $variant->id;
                    $oDetAtr = new DetAtrRepo();
                    $detAtrManager = new DetAtrManager($oDetAtr->getModel(),$detAtr);
                    $detAtrManager->save();
                }
            }

            if($request->input('track') == 1) {
                foreach ($request->input('stock') as $stock) {
                    $stock['variant_id'] = $variant->id;
                    $oStock = new StockRepo();
                    $stockManager = new StockManager($oStock->getModel(), $stock);
                    $stockManager->save();
                }
            }
            return response()->json(['estado'=>true, 'nombres'=>$variant->nombre]);
        }else{
            return response()->json(['estado'=>'Prod sin variantes']);
        }

        //================================./VARIANTES==============================//


    }


    public function findVariant($id)
    {
        $variant = $this->variantRepo->findVariant($id);
        return response()->json($variant);
    }
    public function selectTalla($id,$taco)
    {
        $variant = $this->variantRepo->selectTalla($id,$taco);
        return response()->json($variant);
    }


    public function variants($product_id){

        $product = Product::find($product_id);
        if($product->hasVariants == 1) {
            $variants = $product->variants->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product','detPre' => function($query) use ($product){
                $query->join('presentation','presentation.id','=','detPres.presentation_id')
                ->where('presentation.id',$product->presentation_base);
            },'stock' => function($query){
                $query->where('warehouse_id',1);
            }]);
            //echo 'hi';

        }else{
            $variants = null;
        }

        //$variants = Variant::with('atributes')->get();


        return response()->json($variants);
        //return response()->json(Product::find(2)->with('brand')->get());
    }

    public function variant($product_id){

        $oProduct = Product::find($product_id);
        $product = array();

        if($oProduct->hasVariants == 1){
            $product['product'] = $oProduct;
            $product['stock'] = array();
        }else{
            $product = $oProduct->variant->load(['detPre' => function ($query){
                $query->join('presentation','presentation.id','=','detPres.presentation_id');
                //$query->orderBy('id');
            },'stock','product']);
        }

        return response()->json($product);
    }
    public function editFavoritos(Request $request)
    {
        $vatiant = $this->variantRepo->find($request->id);
        //var_dump($vatiant);
        //die(); 
        $manager = new VariantManager($vatiant,$request->all());
        $manager->save();

        //Event::fire('update.store',$store->all());
        return response()->json(['estado'=>true, 'nombre'=>$vatiant->nombreTienda]);
        }

}
