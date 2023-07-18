<?php

namespace App\Console;

use App\Models\DateReccur;
use Cache;
use Carbon\Carbon;
use Config;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $dateReccur = DateReccur::find(1); 
        $dateEnvoi = $dateReccur->date_envoie;
        $dateStop=$dateReccur->stopenvoie;
        $frequence=$dateReccur->frequence;
        $dateEnvoi = Carbon::parse($dateReccur->date_envoie);

       // $envoieEffectue=Cache::get('envoie_effectue', false);
        $today = Carbon::today();
        if ($today->isSameDay(Carbon::parse($dateEnvoi))) {
            $schedule->command('send:automatic-mail')->everyMinute();
        }
      
        elseif (($today->between($dateEnvoi,$dateStop)) && $frequence==0 ){
            $schedule->command('send:automatic-mail')->everyMinute();
                }
        elseif (($today->lessThanOrEqualTo($dateStop)) && ($today->greaterThan($dateEnvoi) && $frequence==1) )
                {
                   // info('chui la jr');
                    $nextEnvoiDate = $dateEnvoi->copy()->addWeek();
                    while ($nextEnvoiDate->lessThanOrEqualTo($dateStop)) 
                    {
                        if ($today->isSameDay($nextEnvoiDate)) {
                            $schedule->command('send:automatic-mail')->everyMinute();
                            break;
                        }
                        $nextEnvoiDate->addWeek();
                    }
                }
                elseif (($today->lessThanOrEqualTo($dateStop)) && ($today->greaterThan($dateEnvoi) && $frequence==2) )
                {//info('chui la mois');
                    $nextEnvoiDate = $dateEnvoi->copy()->addMonth();
                    while ($nextEnvoiDate->lessThanOrEqualTo($dateStop)) 
                    {
                        if ($today->isSameDay($nextEnvoiDate)) {
                            $schedule->command('send:automatic-mail')->everyMinute();
                            break;
                        }
                        $nextEnvoiDate->addWeek();
                    }
                }
                
    
        else{
            info('La date d\'envoi ne correspond pas à la date d\'aujourd\'hui.');
        }
        
        
           /* ->cron('0 0 * * *')
            ->withoutOverlapping()
            ->when(function () use ($dateEnvoi) {
                $today = Carbon::today();
                $dateToSend = Carbon::parse($dateEnvoi)->startOfDay();
    
                return $today->equalTo($dateToSend);
            });*/
    }


    
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
