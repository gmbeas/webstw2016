<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Steward\Phpcart\Carrito;

class ProductoController extends Controller
{
    //
    public function ficha($sku, $nombre)
    {
        $r         = getFichaProducto(29, $sku);
        $respuesta = $r["_ficha"];

        $producto  = array(
            'codigo'    => $sku,
            'nombre'    => $respuesta[1]['Atributo'],
            'prefijo'   => $respuesta[1]['Atributo'],
            'foto'		=> array(),
            'disponible' => array(
                'venta'   => false,
                'arriendo'=> false
            )
        );

        $excluir = array(
            20,//Precio Unidad
            22,//Precio (sin iva)
            23,//Precio Bruto
            24,//iva
            30,//Precio Unidad Normal
            31,//Precio Unidad Bruto Normal
            32,//Precio Normal
            33,//Precio Bruto Normal
            34,//Iva Normal
            40,//UM
            41//Factor UM
        );

        for( $i = 2;$i < sizeof($respuesta); $i++ ){
            $atributo = $respuesta[$i];

            if( $atributo['Tipo'] == 21 ){
                $producto['precio_unitario'] = $atributo['Grupo'];
                $producto['unidad'] = $atributo['Atributo'];
                $producto['unidad_venta'] = (int)$atributo['Atributo'];
            }
            elseif( $atributo['Tipo'] == '00' ){
                $producto['sku'] = $atributo['Atributo'];
            }
            elseif( $atributo['Tipo'] == '23' ){
                $producto['precio'] = $atributo['Grupo'];
            }
            elseif( $atributo['Tipo'] == '41' ){
                $producto['unidad_venta'] = $atributo['Grupo'];
            }
            elseif( in_array($atributo['Tipo'], array('FT')) ){
                $producto['foto'][] = $atributo['Texto'];
            }
            elseif( $atributo['Tipo'] == 'NW'){
                $producto['NombreWeb'] = $atributo['Texto'];
            }

            elseif( $atributo['Tipo'] == 'ID'){
                $producto['skuid'] = $atributo['Texto'];
            }

            elseif( in_array($atributo['Tipo'], array(50,51)) ){
                if( $atributo['Tipo'] == 50 && $atributo['Atributo'] == 'S' )
                    $producto['disponible']['arriendo'] = true;

                if( $atributo['Tipo'] == 51 && $atributo['Atributo'] == 'S' )
                    $producto['disponible']['venta'] = true;
            }
            elseif(! in_array($atributo['Tipo'],$excluir) ){
                $producto['nombre'] .= ' '.$atributo['Atributo'];
                $producto['caracteristicas'][] = $atributo['Texto'];
            }
        }

        $jjaja = $producto['foto'][0];

        return view('pages.ventas.ficha')
            ->with('producto', $producto);
    }

    public function agregaCarro(Request $request)
    {
        $sku      = $request->input('sku');
        $cantidad = $request->input('cantidad');
        $nombre   = $request->input('nombre');
        $precio   = $request->input('precio');
        $foto     = $request->input('foto');
        $unidad   = $request->input('unidad');
        $skuid	  = $request->input('skuid');

        $cart = new Carrito('ventas');

        $itemx = $cart->get($sku);
        $cantidadx = $cantidad;
        if ($itemx != null)
            $cantidadx = $itemx->cantidad + $cantidad;

        $resultado = getStock(29, $sku, $cantidadx);

        if ($resultado['_stock']['Flag'] == 1) {
            $cart->nombred('ventas')->add([
                'id' => $sku,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio' => $precio,
                'foto' => $foto,
                'unidad' => $unidad,
                'skuid' => $skuid
            ]);

            die(json_encode(array(
                'estado' => 'OK',
                'mensaje' => 'El producto se agregó al carro de compras.',
                'vista' => generaHtml('ventas')
            )));
        } else {
            die(json_encode(array(
                'estado' => 'ERROR',
                'mensaje' => $resultado['_stock']['Mensaje']
            )));
        }



    }

    public function verCarro()
    {
        return view('pages.ventas.vercarro');
    }

    public function elimina($id)
    {
        $cart = new Carrito('ventas');
        $cart->remove($id);
        return Redirect::to('carrito');
    }

    public function disminuirproducto(Request $request)
    {
        $cart       = new Carrito('ventas');
        $sku        = $request->input('id');
        $cantidad   = $request->input('cantidad');
        $unidad     = $request->input('unidad');


        $cart->updateCantidad($sku, $cantidad);
        $totalitem  = $cart->getSumSku($sku);
        $totalCarro = $cart->getBruto("0");
        return  json_encode(array(
            'estado'   => true,
            'mensaje'  => '',
            'totalitem'=> $totalitem,
            'total'    => $totalCarro,
            'vista'    => generaHtml('ventas')
        ));
    }

    public function disminuirproductoFicha(Request $request)
    {

    }

    public function incrementarproductoFicha(Request $request)
    {
        $sku = $request->input('id');
        $cantidad = $request->input('cantidad');
        $cantifin = $cantidad;
        $unidad = $request->input('unidad');

        if ($unidad > 1)
            $cantidad = $cantidad / $unidad;

        $resultado = getStock(29, $sku, $cantidad);

        return json_encode($resultado);

    }

    public function incrementarproducto(Request $request)
    {
        $cart     = new Carrito('ventas');
        $sku      = $request->input('id');
        $cantidad = $request->input('cantidad');
        $cantifin = $cantidad;
        $unidad   = $request->input('unidad');

        if($unidad > 1)
            $cantidad = $cantidad / $unidad;

        $resultado = getStock(29, $sku, $cantidad);
        $stock     = $resultado['_stock'];
        if($stock['Flag'] == 1)
        {

            $cart->updateCantidad($sku, $cantifin);
            $totalitem = $cart->getSumSku($sku);
            $totalCarro = $cart->getBruto("0");

            return  json_encode(array(
                'estado'   => true,
                'mensaje'  => $stock['Mensaje'],
                'totalitem'=> $totalitem,
                'total'    => $totalCarro,
                'vista'    => generaHtml('ventas')
            ));
        }

        return  json_encode(array(
            'estado'   => false,
            'mensaje'  => $stock['Mensaje'],
            'totalitem'=> '',
            'total'    => ''
        ));
    }




    public function verCombox(){
        $r = listaCombosArriendo();

        foreach ($r['_combos'] as $index => $combo) {
            $r2 = getTotalComboArriendo($combo['Cbo_Id'], $combo['Mod_Id'], 10);
            $total = $r2['_total']['ValorBruto'];
            $r['_combos'][$index]['Precio'] = $total;
        }

        return view('pages.arriendo.combos')
            ->with('combos', $r);
    }

    public function detalleCombo($id, $mod, $inv, $nombre)
    {

        $r = getSimulaComboArriendo($id, $mod, $inv);
        $r2 = listaCombosArriendo();

        return view('pages.arriendo.combo')
            ->with('productos', $r)
            ->with('combos', $r2);
    }

    public function cargaNuevoCombo(Request $request)
    {
        $data = $request->all();
        $r = getSimulaComboArriendo($data['cbo'], $data['mod'], $data['inv']);

        foreach ($r['_simula'] as $index => $combo) {
            foreach ($combo['_skus'] as $index2 => $sku) {


                $r['_simula'][$index]['_skus'][$index2]['Url'] = Str::slug($sku['NombreWeb']) . '.html';
            }

        }


        die(json_encode($r));
    }

    public function agregaComboArriendo(Request $request)
    {
        $data = $request->all();
        $cart = new Carrito();
        foreach ($data['data']['Producto'] as $producto) {
            $pp = $producto['id'];


            $cart->nombred('arriendo')->add([
                'id' => $producto['sku'],
                'nombre' => $producto['nombre'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'foto' => $producto['foto'],
                'unidad' => $producto['unidad'],
                'skuid' => $producto['id']
            ]);
        }

        return Redirect::to('arriendo/carrito');
    }

    public function verCarroArriendo()
    {
        return view('pages.arriendo.vercarro');
    }

    public function eliminaArriendo($id)
    {
        $cart = new Carrito('arriendo');
        $cart->remove($id);
        return Redirect::to('arriendo/carrito');
    }

    public function agregaCarroArriendo(Request $request)
    {
        $sku      = $request->input('sku');
        $cantidad = $request->input('cantidad');
        $nombre   = $request->input('nombre');
        $precio   = $request->input('precio');
        $foto     = $request->input('foto');
        $unidad   = $request->input('unidad');
        $skuid	  = $request->input('skuid');

        $cart     = new Carrito();
        $cart->nombred('arriendo')->add([
            'id'		=>	$sku,
            'nombre'	=>	$nombre,
            'cantidad'	=>	$cantidad,
            'precio'	=>	$precio,
            'foto'		=>	$foto,
            'unidad'	=>	$unidad,
            'skuid'		=>	$skuid
        ]);

        die(json_encode(array(
            'estado'  => 'OK',
            'mensaje' => 'El producto se agregó al carro de arriendo.',
            'vista'	  => generaHtmlArriendo('arriendo')
        )));
    }

    public function fichaArriendo($sku, $nombre)
    {
        $r         = getFichaProducto(30, $sku);
        $respuesta = $r["_ficha"];

        $producto  = array(
            'codigo'    => $sku,
            'nombre'    => $respuesta[1]['Atributo'],
            'prefijo'   => $respuesta[1]['Atributo'],
            'foto'		=> array(),
            'disponible' => array(
                'venta'   => false,
                'arriendo'=> false
            )
        );

        $excluir = array(
            20,//Precio Unidad
            22,//Precio (sin iva)
            23,//Precio Bruto
            24,//iva
            30,//Precio Unidad Normal
            31,//Precio Unidad Bruto Normal
            32,//Precio Normal
            33,//Precio Bruto Normal
            34,//Iva Normal
            40,//UM
            41//Factor UM
        );

        for( $i = 2;$i < sizeof($respuesta); $i++ ){
            $atributo = $respuesta[$i];

            if( $atributo['Tipo'] == 21 ){
                $producto['precio_unitario'] = $atributo['Grupo'];
                $producto['unidad'] = $atributo['Atributo'];
                $producto['unidad_venta'] = (int)$atributo['Atributo'];
            }
            elseif( $atributo['Tipo'] == '00' ){
                $producto['sku'] = $atributo['Atributo'];
            }
            elseif( $atributo['Tipo'] == '23' ){
                $producto['precio'] = $atributo['Grupo'];
            }
            elseif( $atributo['Tipo'] == '41' ){
                $producto['unidad_venta'] = $atributo['Grupo'];
            }
            elseif( in_array($atributo['Tipo'], array('FT')) ){
                $producto['foto'][] = $atributo['Texto'];
            }
            elseif( $atributo['Tipo'] == 'NW'){
                $producto['NombreWeb'] = $atributo['Texto'];
            }

            elseif( $atributo['Tipo'] == 'ID'){
                $producto['skuid'] = $atributo['Texto'];
            }

            elseif( in_array($atributo['Tipo'], array(50,51)) ){
                if( $atributo['Tipo'] == 50 && $atributo['Atributo'] == 'S' )
                    $producto['disponible']['arriendo'] = true;

                if( $atributo['Tipo'] == 51 && $atributo['Atributo'] == 'S' )
                    $producto['disponible']['venta'] = true;
            }
            elseif(! in_array($atributo['Tipo'],$excluir) ){
                $producto['nombre'] .= ' '.$atributo['Atributo'];
                $producto['caracteristicas'][] = $atributo['Texto'];
            }
        }

        return view('pages.arriendo.ficha')
            ->with('producto', $producto);
    }

    public function disminuirproductoArriendo(Request $request)
    {
        $cart       = new Carrito('arriendo');
        $sku        = $request->input('id');
        $cantidad   = $request->input('cantidad');
        $unidad     = $request->input('unidad');

        $cart->updateCantidad($sku, $cantidad);
        $totalitem  = $cart->getSumSku($sku);
        $totalCarro = $cart->getBruto("0");
        return  json_encode(array(
            'estado'   => true,
            'mensaje'  => '',
            'totalitem'=> $totalitem,
            'total'    => $totalCarro,
            'vista'    => generaHtmlArriendo('arriendo')
        ));
    }

    public function incrementarproductoArriendo(Request $request)
    {
        $cart     = new Carrito('arriendo');
        $sku      = $request->input('id');
        $cantidad = $request->input('cantidad');
        $cantifin = $cantidad;
        $unidad   = $request->input('unidad');

        if($unidad > 1)
            $cantidad = $cantidad / $unidad;

        $resultado = getStock(30, $sku, $cantidad);
        $stock     = $resultado['_stock'];
        if($stock['Flag'] == 1)
        {

            $cart->updateCantidad($sku, $cantifin);
            $totalitem = $cart->getSumSku($sku);
            $totalCarro = $cart->getBruto("0");

            return  json_encode(array(
                'estado'   => true,
                'mensaje'  => $stock['Mensaje'],
                'totalitem'=> $totalitem,
                'total'    => $totalCarro,
                'vista'    => generaHtmlArriendo('arriendo')
            ));
        }

        return  json_encode(array(
            'estado'   => false,
            'mensaje'  => $stock['Mensaje'],
            'totalitem'=> '',
            'total'    => ''
        ));
    }
}
