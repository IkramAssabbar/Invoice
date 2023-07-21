<?php
  
namespace App\Mail;

use App\Models\BonCommande;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\FactureReccurente;
use App\Models\FactureService;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class BonComMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $data=[];
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  $latestfacture = BonCommande::latest()->first();
        $bncmd=$latestfacture->id;
        $entreprises=Entreprise::all();
        $facture = BonCommande::find($bncmd);
        $services = $facture->services;

        //$idservices=FactureService::find($facture->id);
        //$services = Service::whereIn('id', $idservices)->get();
        return $this->from('imalak419@gmail.com', 'Ikram Malak')
        ->subject($this->data["subject"])
                    ->view('EmailsView.MailViewBonC')->with([
        "data" => $this->data,
        "facture" => $facture,
        "entreprises"=>$entreprises,
        "services"=>$services]);
    }
}