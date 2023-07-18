<?php

namespace App\Console\Commands;

use App\Mail\MailNotify;
use App\Models\Client;
use App\Models\Facture;
use Exception;
use Illuminate\Console\Command;
use Mail;
use Request;

class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:automatic-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envoie des emails reccurrentes';

    /**
     * Execute the console command.
     */
    public function handle(Request $request)
    {
        $data = [
            "subject" => "MGA Invoice Notify",
            "body" => "Bonjour,Veuillez trouver ci-joint votre facture de MGA"
        ];
        $users = Client::where('subscribe', true)->get();
      //  $subscriberIds = Client::where('subscribe', true)->pluck('id');
    //$factures = Facture::whereIn('Idclient', $subscriberIds)->get();

    
    // MailNotify class that is extend from Mailable class.
    try
    {
      
        foreach ($users as $user) {
        Mail::to($user->email)->send(new MailNotify($data));
        $this->info('E-mail sent successfully');
        }
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return  $this->error(['Sorry! Please try again latter']);
    }
    }
}
