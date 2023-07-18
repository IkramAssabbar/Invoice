<div class="container-fluid mt--7">
    <div class="row">
        <!-- Partie société -->
        <div class="col-md-6" style="font-size: 17px">
            <b>MGA</b><br>
            elwafae, fes<br>
            fes, 3000<br>
            Maroc<br>
            ICE : 1245775<br><br>
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
        <div class="col-md-6" style="font-size: 17px ;margin-top: -70px;">
            <b>Date: {{ $devis->date }}</b><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table style="border-collapse: separate; border-spacing: 10px;">
                <thead>
                    <tr>
                        <th style="padding-right: 89px;">Référence</th>
                        <th style="padding-right: 89px;">Libellé</th>
                        <th style="padding-right: 89px;">Prix</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-right: 89px;">{{ $service->id }}</td>
                        <td style="padding-right: 89px;">{{ $service->libelle }}</td>
                        <td style="padding-right: 89px;">{{ $service->prix }} DH</td>
                        <td>{{ $service->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row justify-content-end" style="text-align: right; margin-top: 50px; margin-bottom: 50px;">
        <div class="col-md-9 ml-auto" >
            <table>
                <tr>
                    <td>Remise globale:</td>
                    <td style="padding-left: 20px;">{{ $devis->remise }} DH</td>
                </tr>
                <tr>
                    <td>Total HTVA:</td>
                    <td style="padding-left: 20px;">{{ $devis->montantHtva }} DH</td>
                </tr>
                <tr>
                    <td>TVA :</td>
                    <td style="padding-left: 20px;">{{ $devis->tva }} DH</td>
                </tr>
                <tr>
                    <td style="color:rgb(41, 136, 220);">Total:</td>
                    <td style="padding-left: 20px;">{{ $devis->montantTotal }} DH</td>
                </tr>
            </table>
        </div>
    </div>
</div>
