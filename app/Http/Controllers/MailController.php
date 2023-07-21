<?php
 
namespace App\Http\Controllers;

use App\Mail\BonComMail;
use App\Mail\BonLivMail;
use App\Mail\DevisMail;
use Illuminate\Http\Request;
use Mail;
use Exception;
use App\Mail\MailNotify;
use App\Models\BonCommande;
use App\Models\BonLivraison;
use App\Models\DateReccur;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\FactureReccurente;
use App\Models\Historique;
use Artisan;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;


class MailController extends Controller
{
     
  public function index(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');
    $destin=$request->input('destin');
    $clientname=$request->input('clientname');
  

   $data = [
       "subject" =>$subject ,
       "body" =>  $body ,
       "destin" =>$destin
   ];

   $user = Auth::user();
   $factureid = $request->input('factureid');
        Historique::create([
            'iduser' => $user->id,
            'type' => 'envoie',
            'message' => $user->name . ' a envoyé la facture N° ' . $factureid . ' a ' . $clientname
            //'idfacture' => $factureid
        ]);
    // MailNotify class that is extend from Mailable class.
    try
    {
      $f=Facture::find($factureid);
      $f->status='Envoyée';
      $f->save();
        Mail::to($destin)->send(new MailNotify($data));
       
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return response()->json(['Sorry! Please try again latter']);
    }
    

  } 

  public function indexDevis(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');
    $destin=$request->input('destin');
    $clientname=$request->input('clientname');
  

   $data = [
       "subject" =>$subject ,
       "body" =>  $body ,
       "destin" =>$destin
   ];

   $user = Auth::user();
   $devisid = $request->input('devisid');
        Historique::create([
            'iduser' => $user->id,
            'type' => 'envoie',
            'message' => $user->name . ' a envoyé le devis N° ' . $devisid . ' à ' . $clientname
            //'idfacture' => $factureid
        ]);
    // MailNotify class that is extend from Mailable class.
    try
    {
      $f=Devis::find($devisid);
      $f->status='Envoyée';
      $f->save();
        Mail::to($destin)->send(new DevisMail($data));
       
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return response()->json(['Sorry! Please try again latter']);
    }
    

  } 
  //mail recrrente 

  public function indexrecu(Request $request)
  {
    
      
  
    $user = Auth::user();
    $factureid = $request->input('factureid');
         Historique::create([
             'iduser' => $user->id,
             'type' => 'envoie',
             'message' => $user->name . ' a envoyé la facture reccurente N° ' . $factureid .'aux Abonnés'
           
         ]);
   
            $dateReccur = DateReccur::find(1); 
            $dateEnvoi = $dateReccur->date_envoie;
            
            $today = Carbon::today();
            if ($today->isSameDay(Carbon::parse($dateEnvoi)))
                // Exécutez la commande personnalisée en utilisant Artisan
              { Artisan::call('send:automatic-mail');
                $f=FactureReccurente::find($factureid);
                $f->status='Envoyée';
                $f->save();
                // Planifiez l'exécution de la commande personnalisée à la prochaine minute
                Artisan::call('schedule:run');
            
              return response()->json(['Great! Successfully sent your mail']);
       }
      


    else
     {
      return  response()->json(['date ulterieur']);
      }


  } 

  //bonne de commande 
  public function indexComm(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');
    $destin=$request->input('destin');
    $clientname=$request->input('clientname');

   $data = [
       "subject" =>$subject ,
       "body" =>  $body ,
       "destin" =>$destin
   ];

   $user = Auth::user();
   $Boncmdid = $request->input('BonComid');
        Historique::create([
            'iduser' => $user->id,
            'type' => 'envoie',
            'message' => $user->name . ' a envoyé le bon de commande N° ' . $Boncmdid. ' a ' . $clientname
            //'idfacture' => $factureid
        ]);
    // MailNotify class that is extend from Mailable class.
    try
    { $f=BonCommande::find($Boncmdid);
      $f->status='Envoyée';
      $f->save();
        Mail::to($destin)->send(new BonComMail($data));
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return response()->json(['Sorry! Please try again latter']);
    }
    

  } 
  //index livraison 
  public function indexLivrai(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');
    $destin=$request->input('destin');
    $clientname=$request->input('clientname');

   $data = [
       "subject" =>$subject ,
       "body" =>  $body ,
       "destin" =>$destin
   ];

   $user = Auth::user();
   $Bonlivid = $request->input('Bonlivid');
        Historique::create([
            'iduser' => $user->id,
            'type' => 'envoie',
            'message' => $user->name . ' a envoyé le bon de livraison  N° ' . $Bonlivid. ' a ' . $clientname
            //'idfacture' => $factureid
        ]);
    // MailNotify class that is extend from Mailable class.
    try
    { $f=BonLivraison::find($Bonlivid);
      $f->status='Envoyée';
      $f->save();
        Mail::to($destin)->send(new BonLivMail($data));
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return response()->json(['Sorry! Please try again latter']);
    }
    

  } 
}