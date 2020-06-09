<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style >
    html{
        margin-top: 50px;
        margin-left: 5px;
        margin-right: 5px;
    }
    body{
        font-size: 8pt;
    }

    .table-header{
        background-color: #223A5E;
        color: white;
    }

    .border{
        border: 1px solid #e5e9f0;
    }

    .colcodigo{
        width: 10%;
    }

    .colconcepto{
        width: 60%;
    }

    .colcreditos{
        width: 10%;
    }

    .colvalor{
        width: 20%;
    }

    .coldocumento{
        width: 20%;
    }

    .colnombre{
        width: 40%;
    }
    .colfecha{
        width: 10%;
        text-align: center;
    }
    .colperiodo{
        width: 10%;
        text-align: center;
    }

    img{
        width: 200px;
        height: 100%;
    }

    .blank-cell{
        height: 15px;
    }
</style>
    </head>
    <body>
        <div class="container">
            <img src="https://www.uniremington.edu.co/wp-content/uploads/2019/02/logo-universdad.png" class="mb-2">

            <div class="row">
              <div class="col-12">
                  <!-- <div class="table-responsive-sm"> -->

                      <div class="row">
                          <table class="table table-condensed table-bordered table-sm">
                              <tbody>
                                  <tr class="font-weight-bold table-header text-center">
                                      <td>Fecha</td>
                                      <td>Periodo</td>
                                      <td colspan="4">Datos del Estudiante</td>
                                  </tr>
                                  <tr>
                                      <td class="colfecha">{{ date('Y-m-d') }}</td>
                                      <td class="colperiodo">2020-2</td>
                                      <td class="font-weight-bold">Identificación</td>
                                      <td class="coldocumento">{{$estudiante['numero_documento']}}</td>
                                      <td class="font-weight-bold">Nombre</td>
                                      <td class="colnombre">{{$estudiante['nombre']}}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="row">
                          <table id="detalle" class="table table-condensed table-borderless table-sm">
                              <thead>
                                  <tr class="text-center font-weight-bold table-header">
                                      <th class="colcodigo">Código</th>
                                      <th class="colconcepto">Concepto</th>
                                      <th class="colcreditos">Créditos</th>
                                      <th class="colvalor">Valor</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($detalle as $materia)
                                  <tr>
                                      <td class="border text-center">{{ $materia['codigo'] }}</td>
                                      <td class="border">{{ $materia['materia'] }}</td>
                                      <td class="border text-center">{{ $materia['creditos'] }}</td>
                                      <td class="border text-right">{{ $materia['valor'] }}</td>
                                  </tr>
                                  @endforeach
                                  <tr class="text-right font-weight-bold">
                                      <td colspan="2"></td>
                                      <td class="table-header ">Subtotal</td>
                                      <td class="border text-right ">$ {{$encabezado['subtotal']}}</td>
                                  </tr>
                                  <tr class="text-right font-weight-bold">
                                      <td colspan="2"></td>
                                      <td class="border table-header">Descuento</td>
                                      <td class="border">$ {{$encabezado['descuento']}}</td>
                                  </tr>
                                  <tr class="text-right font-weight-bold">
                                      <td colspan="2"></td>
                                      <td class="border table-header">Total</td>
                                      <td class="border">$ {{$encabezado['subtotal'] - $encabezado['descuento']}}</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  <!-- </div> -->
              </div>
            </div>
            <div class="row">
                <div class="col-5 pl-0">
                    <table class="table table-condensed table-sm">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold col-5 border">Fecha Pago Ordinario</td>
                                <td class="col border">{{ $encabezado['fecha_pago_ordinario'] }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold col-6 border">Fecha Pago con Recargo</td>
                                <td class="border">{{ $encabezado['fecha_pago_extra'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col pl-0">
                <p>Si en el momento de realizar el pago se excede la fecha límite indicada deberá reimprimir este documento con los nuevos valores liquidados </p></div>
            </div>
            <div class="row">
                <div class="col-12">
                        <div class="card-header text-center pt-1 pb-1">
                            DOCUMENTO PARA EL ESTUDIANTE
                        </div>
                   
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div style="border-style: dotted;"></div>
            </div>
            <br>
            <br>
            <div class="row" style="font-size: 7pt;">
                <div class="col-6">
                    <div class="row">
                        <table class="table table-condensed table-bordered table-sm">
                            <tbody>
                                <tr class="text-center font-weight-bold">
                                    <td colspan="5">ESTUDIANTE: {{$estudiante['numero_documento']}} / {{$estudiante['nombre']}}</td>
                                </tr>
                                <tr class="font-weight-bold table-header text-center">
                                    <td  colspan="3">FECHA</td>
                                    <td  colspan="2">TOTAL A PAGAR</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="3"> {{ date('Y-m-d') }} </td>
                                    <td colspan="2">{{$encabezado['subtotal'] - $encabezado['descuento']}}</td>
                                </tr>
                                <tr class="font-weight-bold table-header text-center">
                                    <td colspan="3">RELACION DE CHEQUES</td>
                                    <td colspan="2">VALOR</td>
                                </tr>
                                <tr class="text-center">
                                    <td style="width: 10%;">COD. BCO.</td>
                                    <td style="width: 20%;">CHEQUE No.</td>
                                    <td style="width: 10%;">No. CHEQUES</td>
                                    <td class="text-left" style="width: 30%;">EFECTIVO</td>
                                    <td style="width: 30%;"></td>
                                </tr>   
                                <tr>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell">CH. DE ESTE BCO.</td>
                                    <td class="blank-cell"></td>
                                </tr>  
                                <tr>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell">CH. DE OTROS BCO.</td>
                                    <td class="blank-cell"></td>
                                </tr>   
                                <tr>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell"></td>
                                    <td class="blank-cell">TOTAL A PAGAR</td>
                                    <td class="blank-cell"></td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-center pt-1 pb-1">
                            DOCUMENTO PARA EL BANCO
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="border-style: dotted;"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
