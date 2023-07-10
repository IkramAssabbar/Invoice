<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Mail;
use Exception;
use App\Mail\MailNotify;

class MailController extends Controller
{
     
  public function index(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');
    $destin=$request->input('destin');

   $data = [
       "subject" =>$subject ,
       "body" =>  $body ,
       "destin" =>$destin
   ];
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