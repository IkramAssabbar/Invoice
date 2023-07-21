<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notify</title>
</head>
<body>
    <p>{{ $data['body'] }}</p>

        <h3 style="font-weight: bold; text-align: center;">Nouvelle Facture de Maroc Generation Agency</h3>
<div style="border: 1px solid black; padding: 20px; max-width: 600px; margin: 0 auto;">

    <h3 style="font-weight: bold; text-align: center;">Facture</h3>

    <br>
    <br>
    <div style="margin-top: 40px; font-size: 17px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    @foreach($entreprises as $entreprise)
                    <b>{{ $entreprise->Nom_Commercial }}</b><br>
                    {{ $entreprise->Ville }} {{ $entreprise->CP }}<br>
                    {{ $entreprise->Pays }}<br>
                    {{ $entreprise->ICE }}<br><br>
                    @endforeach
                </td>
                <td style="width: 50%; text-align: right;">
                    <b>Client: {{ $facture->client->nom }} {{ $facture->client->prenom }}</b><br>
                    Adresse: {{ $facture->client->adresse }}<br>
                    {{ $facture->client->ville}},{{ $facture->client->cp }}<br>
                    {{ $facture->client->pays }}<br><br>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: -40px;">
            <tr>
                <td style="width: 50%;">
                    <b>Date:</b> {{ $facture->date }}<br>
                    <b style="color: red;">Échéance:</b> {{ $facture->echeance }}
                </td>
               
            </tr>
        </table>
        <table class="table table-striped "style="width: 100%; max-width: 100%; table-layout: fixed;" >
            <thead>
                <tr>
                    <th style="border: 1px solid #dddddd; padding-right: 89px; text-align: left; background-color: #f9f9f9;">Référence</th>
                    <th style="border: 1px solid #dddddd; padding-right: 89px; text-align: left; background-color: #f9f9f9;">Libellé</th>
                    <th style="border: 1px solid #dddddd; padding-right: 89px; text-align: left; background-color: #f9f9f9;">Prix</th>
                    <th style="border: 1px solid #dddddd;padding-right: 89px; text-align: left; background-color: #f9f9f9;" >Description</th>
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
        <table style="width: 100%; margin-top: 50px; margin-bottom: 50px;">
            <tr>
                <td>Remise globale:</td>
                <td style="padding-left: 5px;">{{ $facture->remise}} DH</td>
            </tr>
            <tr>
                <td>Total HTVA:</td>
                <td style="padding-left: 5px;">{{ $facture->montantHtva}}DH</td>
            </tr>
            <tr>
                <td>TVA :</td>
                <td style="padding-left: 5px;">{{ $facture->tva }} DH</td>
            </tr>
            <tr>
                <td style="color:rgb(41, 136, 220);">Total:</td>
                <td style="padding-left: 5px;">{{ $facture->montantTotal }}DH</td>
            </tr>
        </table>
        <table style="width: 100%;">
            @foreach($entreprises as $entreprise)
            <tr>
                <td><H5>| Patente: {{ $entreprise->Patente }} >>>>| IF: {{ $entreprise->IF }}</H5></td>
            </tr>
            
            @endforeach
        </table>
    </div>
    
       
    <h4> Sincères salutations </h4>
    <H5>MGA</H5>
</div>

</body>
</html>