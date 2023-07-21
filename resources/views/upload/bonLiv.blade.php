<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bon livraison</title>
    <style>
        .border-black {
            border: 2px solid black;
            padding: 20px; /* Ajoutez un padding pour l'espace entre le contenu et la bordure */
        }
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500vh; /* Ajustez cette valeur selon vos besoins */
        }
    </style>
</head>
<body>
 
    <div class=" center-container border-black ">
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-12" style="text-align: center; font-weight: bold;">
                <h2>Bon de Livraison </h2>
            </div>
        </div>
            <!-- Partie société -->
            <div class="col-md-6" style="font-size: 17px">
              
                <table>
                    <tbody>
                        @foreach($entreprises as $entreprise)
            <tr> <b>{{$entreprise->Nom_Commercial}}</b><br></tr>
           
              <tr> <b>{{$entreprise->Ville}} {{$entreprise->CP}}</b><br></tr>
              <tr><b>{{$entreprise->Pays}}</b><br></tr> 
              <tr><b>{{$entreprise->ICE}}</b><br><br></tr> 
              @endforeach
            </tbody>
                </table>
               
           
            </div>
            <!-- Partie client -->
            <div class="col-md-6" style="font-size: 17px; text-align: right; margin:10px">
                <b>Client: {{ $client->nom }} {{ $client->prenom }}</b><br>
                Adresse: {{ $client->adresse }}<br>
                {{ $client->ville }}, {{ $client->cp }}<br>
                {{ $client->pays }}<br><br>
            </div>
        </div>
        <div class="row">
            <!-- Partie date -->
            <div class="col-md-6" style="font-size: 17px; margin-top: -70px;">
                <table>
                    <tbody>
                        <tr>
                            <td><b>Date:</b></td>
                            <td>{{ $date }}</td>
                        </tr>
                        <tr>
                            <td><b style="color: red">Date de Livraison:</b></td>
                            <td style="color: red">{{ $echeance }}</td>
                        </tr>
                        <tr>
                            <td><b >Adresse de livraison:</b></td>
                            <td >{{ $adresse }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #dddddd; padding-right: 89px; text-align: left; background-color: #f9f9f9;">Référence</th>
                            <th style="border: 1px solid #dddddd; padding-right 89px; text-align: left; background-color: #f9f9f9;">Libellé</th>
                            <th style="border: 1px solid #dddddd; padding-right 89px; text-align: left; background-color: #f9f9f9;">Prix</th>
                            <th style="border: 1px solid #dddddd;padding-right 89px; text-align: left; background-color: #f9f9f9;" >Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td style="padding-right: 89px;border: 1px solid #dddddd;  text-align: left;">{{ $service->id }}</td>
                                <td style="padding-right: 89px;border: 1px solid #dddddd; text-align: left;">{{ $service->Libelle }}</td>
                                <td style="padding-right: 89px;border: 1px solid #dddddd; text-align: left;">{{ $service->Prix }} DH</td>
                                <td style="border: 1px solid #dddddd; padding: 8px; text-align: left;" >{{ $service->Description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row justify-content-end" style="text-align: right; margin-top: 50px; margin-bottom: 50px;">
            <div class="col-md-9 ml-auto" >
                <table>
                    <tr>
                        <td>Remise globale:</td>
                        <td style="padding-left: 20px;">{{ $remise }} DH</td>
                    </tr>
                    <tr>
                        <td>Total HTVA:</td>
                        <td style="padding-left: 20px;">{{ $montantHtva }} DH</td>
                    </tr>
                    <tr>
                        <td>TVA :</td>
                        <td style="padding-left: 20px;">{{ $tva }} DH</td>
                    </tr>
                    <tr>
                        <td style="color:rgb(220, 41, 53);"><b>Total:</b></td>
                        <td style="padding-left: 20px;color:rgb(220, 41, 53);"><b>{{ $montantTotal }}</b> DH</td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
           
         <table >
            <tbody>
                @foreach($entreprises as $entreprise)
            <tr>
                
                <td><H5>|pattent:{{$entreprise->Patente}} >>>>|IF:{{$entreprise->IF}}</H5></td>
              
            
            </tr>
            <tr>
                <td>  <h5 id="mt">Veuillez payez le montant de {{$montantTotal}} avant le {{$echeance}} </h5></td>
            </tr>
        </tbody>
         </table>
         @endforeach
        </div>
        <br>
        <br>
        <h5>Merci de votre Confiance!</h5>
        <b>MGA</b>
    </div>
    </div>

</body>
</html>