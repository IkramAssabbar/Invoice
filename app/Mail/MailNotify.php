<?php
  
namespace App\Mail;

use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\FactureService;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class MailNotify extends Mailable
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
    {  $latestfacture = Facture::latest()->first();
        $factureId=$latestfacture->id;
        $entreprises=Entreprise::all();
        $facture = Facture::find($factureId);
        $services = $facture->services;

        //$idservices=FactureService::find($facture->id);
        //$services = Service::whereIn('id', $idservices)->get();
        return $this->from('imalak419@gmail.com', 'Ikram Malak')
        ->subject($this->data["subject"])
                    ->view('EmailsView.NotifymessView')->with([
        "data" => $this->data,
        "facture" => $facture,
        "entreprises"=>$entreprises,
        "services"=>$services]);
    }
}