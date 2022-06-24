<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title >{{$sale->created_at->format('d/m/y')}}</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            h1,h2,h3,h4,h5,h6,p,span,div {
                font-family: DejaVu Sans;
                font-size:10px;
                font-weight: normal;
            }
            th,td {
                font-family: DejaVu Sans;
                font-size:10px;
            }
            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .panel-default {
                border-color: #ddd;
            }
            .panel-body {
                padding: 15px;
            }
            table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0px;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;
            }
            thead  {
                text-align: left;
                display: table-header-group;
                vertical-align: middle;
            }
            th, td  {
                vertical-align: middle;
                border: 1px solid rgb(116, 114, 114);
                padding: 6px;
            }
            .well {
                min-height: 20px;
                padding: 19px;
                margin-bottom: 20px;
                background-color: #f5f5f5;
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            }

        </style>

    </head>
    <body>
        <header>
            <div style="position:absolute; left:0pt; width:250pt;">
                <img width="120" src='data:image/png;base64, {{ base64_encode(file_get_contents(public_path('/images/photo.png'))) }}' alt="Logo" />
            </div>
            <div style="margin-left:300pt;">
                <b>Date: {{$sale->created_at->format('d/m/Y')}}</b><br />
                    <h2>Facture de: {{$sale->customer->name}}</h2>

                <br />
                <span ><?php echo DNS2D::getBarcodeHTML($sale->customer->name,  'QRCODE');?>
                </span><br>
            </div>
            <br />

        </header>
        <main>
            <div style="clear:both; position:relative;">
                <div style="position:absolute; left:0pt; width:250pt;">
                    <h4> Details de fournisseur:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                           Hraoui mohamed<br />
                            ID: 125125988<br />
                            0693936271<br />
                            bouchfaa centre oued amlil<br />
                           35273 TAZA<br/>
                           Maroc<br />
                        </div>
                    </div>
                </div>
                <div style="margin-left: 300pt;">
                    <h4>Détails de client:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img width="153" src='data:image/png;base64, {{ base64_encode(file_get_contents(public_path('/images/melazur.png'))) }}' alt="Logo" /><br />
                            ID: 02120210120<br />
                           {{$sale->customer->phone}}<br />
                           rabat<br />
                            11000
                           Maroc<br />
                        </div>
                    </div>
                </div>
            </div>
            <h4>Détails de la facture:</h4>
            <table class="table table-bordred" style="text-align: center; vertical-align: middle">
                <thead >
                    <tr>
                        <th>catégorie</th>
                        <th>Produit</th>
                        <th>quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($sale->products as $sold_product)
                                <tr>

                                    <td class="align-middle">{{ $sold_product->product->category->name }}</a></td>
                                    <td class="align-middle">{{ $sold_product->product->name }}</a></td>
                                    <td class="align-middle">{{ $sold_product->qty }}</td>
                                    <td class="align-middle">{{ ($sold_product->price) }}</td>
                                    <td class="align-middle">{{ ($sold_product->total_amount) }} dhs</td>

                                </tr>
                            @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td><strong>Total</strong></td>
                    <td>{{ ($sale->products->sum('total_amount')) }}DHS</td>
                </tr>
                </tfoot>
            </table>


        </main>

        <!-- Page count -->
         <footer
            style="position:fixed; bottom:3rem; left:0;  text-align: left; width: 100%; vertical-align:bottom; border-top: 1px solid lightgray; padding:10px 0px; font-size: 80%;">
            <table  class="table  text-nowrap" style="text-align: center; vertical-align: middle">
               <td>email:medhra@gmail.com</td>
               <td>phone:0693936271</td>
               <td>adresse: bouchfaa centre taza</td>
            </table>
        </footer>

    </body>
</html>
