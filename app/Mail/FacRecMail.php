<?php
  
namespace App\Mail;

use App\Models\BonCommande;
use App\Models\BonLivraison;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\FactureReccurente;
use App\Models\FactureService;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class FacRecMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $data=[];
  public $client;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$client)
    {
        $this->data= $data;
        $this->client = $client;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  $latestfacture = FactureReccurente::latest()->first();
        $facR=$latestfacture->id;
        $entreprises=Entreprise::all();
        $facture = FactureReccurente::find($facR);
        $services = $facture->services;

        //$idservices=FactureService::find($facture->id);
        //$services = Service::whereIn('id', $idservices)->get();
        return $this->from('imalak419@gmail.com', 'Ikram Malak')
        ->subject($this->data["subject"])
                    ->view('EmailsView.MailViewRec')->with([
        "data" => $this->data,
        "facture" => $facture,
        "entreprises"=>$entreprises,
        "services"=>$services]);
    }
}