<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Usuario;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PagoFacilController extends Controller
{
    public function RecolectarDatos(Request $request, Usuario $usuario, Pedido $pedido, $nit)
    {
        try {
            $detalle = PedidoDetalle::where('pedido_id', $pedido->id)->get();
            $taPedidoDetalle = [];
            foreach ($detalle as $item) {
                $taPedidoDetalle[] = [
                    "tnCantidad" => $item->cantidad,
                    "tcDescripcion" => $item->producto->nombre,
                    "tnPrecioUnitario" => $item->precio,
                    "tnSubTotal" => $item->precio * $item->cantidad
                ];
            }
            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $usuario->telefono;
            $lcNombreUsuario       = $usuario->nombre;
            $lnCiNit               = $nit;
            $lcNroPago             = "grupo06sc-" . rand(100000, 999999);
            $lnMontoClienteEmpresa = $pedido->monto_total;
            $lcCorreo              = $usuario->correo;
            $lcUrlCallBack         = "http://localhost:8000/pago_facil/callback/" . $pedido->id;
            $lcUrlReturn           = "http://localhost:8000/pago_facil/callback/" . $pedido->id;
            $laPedidoDetalle       = $taPedidoDetalle;
            $lcUrl                 = "";

            $loClient = new Client();
            $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());
            $laValues = explode(";", $laResult->values)[1];
            $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
            $laQrImage = base64_encode($laQrImage);
            $laQrImage = '<img src="data:image/png;base64,' . $laQrImage . '" class="img-fluid" alt="QR Code" />';
            $laQrImage = '<div class="text-center">' . $laQrImage . '</div>';
            return response()->json($laQrImage);
        } catch (\Throwable $th) {
            return $th->getMessage() . " - " . $th->getLine();
        }
    }

    public function ConsultarEstado(Request $request)
    {
        $lnTransaccion = $request->tnTransaccion;

        $loClientEstado = new Client();

        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
            'headers' => $laHeaderEstadoTransaccion,
            'json' => $laBodyEstadoTransaccion
        ]);

        $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());
        $texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';
        return response()->json(['message' => $texto]);
    }

    public function urlCallback(Request $request, Pedido $pedido)
    {
        $pedido->estado =  $request->input("Estado");
        $pedido->save();
        try {
            $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
        } catch (\Throwable $th) {
            $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
        }
        return response()->json($arreglo);
    }
}
