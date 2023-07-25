<?php

namespace App\Console;

use App\Models\NotificationsModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    // 27-07-2022
        $schedule->call(function () {
            $date = Carbon::now()->subDays(2);
            $important = NotificationsModel::with('users')->where('due_date', '=', $date)->get();
            foreach($important as $key => $value)
            {
                $speaker_phone=$value->users->phone;
                $this->send_sms($speaker_phone);
            }
           // DB::table('inactive_users')->delete();
        })->daily();
    }

    function send_sms($speaker_phone)
	{
		//This is SMS template use same for testing, will share updated one once registered
		$Dlt = '1207164302276201210';
		//Actual message going to user
		$message = urlencode("Toujeo Basal Academy update: Congratulations on successfully completing your Module on Wed Jul 27 2022 at 3:01 pm IST. We will soon reach out to you with further updates -Basal Academy");
		$route = 4;
		//SMS sender ID
	//	$speaker_phone = "8893670517";
		$senderId = "BASLAC";
		//Actual Data
		$postData = array(
			'mobiles' => $speaker_phone,
			'message' => $message,
			"DLT_TE_ID" => $Dlt,
			'sender' => $senderId,
			'route' => $route
		);

		$url = "http://api.msg91.com/api/v2/sendsms";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => array(
				"authkey: 268197A5ZORkn1DU0L60fe3d1aP1",
				"content-type: multipart/form-data"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
