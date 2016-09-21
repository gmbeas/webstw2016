<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductoController extends Controller
{
    //
    public function ficha($sku, $nombre)
    {
        $r         = getFichaProducto($sku);
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
}
