<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Mail;
use Exception;
use App\Mail\MailNotify;
use App\Models\DateReccur;
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
        Mail::to($destin)->send(new MailNotify($data));
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
  {$user = Auth::user();
    $factureid = $request->input('factureid');
         Historique::create([
             'iduser' => $user->id,
             'type' => 'envoie',
             'message' => $user->name . ' a envoyé la facture reccurente N° ' . $factureid,
             //'idfacture' => $factureid
         ]);
   // $dateEnvoi = $request->input('date_envoi');
    $dateReccur = DateReccur::find(1); 
    $dateEnvoi = $dateReccur->date_envoie;
    // Stocker la valeur de date_envoi dans la configuration de l'application
   // Config::set('app.date_envoi', $dateEnvoi);
    $today = Carbon::today();
    if ($today->isSameDay(Carbon::parse($dateEnvoi)))
        // Exécutez la commande personnalisée en utilisant Artisan
       { Artisan::call('send:automatic-mail');
        // Planifiez l'exécution de la commande personnalisée à la prochaine minute
        Artisan::call('schedule:run');
         // MailNotify class that is extend from Mailable class.
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
    {
        Mail::to($destin)->send(new MailNotify($data));
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
    {
        Mail::to($destin)->send(new MailNotify($data));
      return response()->json(['Great! Successfully send in your mail']);
    }
    catch(Exception $e)
    {
        dd($e->getMessage());
      return response()->json(['Sorry! Please try again latter']);
    }
    

  } 
}