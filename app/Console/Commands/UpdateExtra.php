<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\ExtraRepository;

use App\Models\Extra;
use App\Models\Student;
use App\Models\Professional;
use App\Models\User;

use Carbon\Carbon;

use Mail;

class UpdateExtra extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extra:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the extras';

    protected $extraRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ExtraRepository $extraRepository)
    {
        parent::__construct();
        $this->extraRepository = $extraRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info('Run extrasme update');

        $extras = Extra::orderBy('date', 'ASC')->where('finish', 0)->where('find', 0)->where('open', 0)->get();

        foreach ($extras as $extra) {

            $postDate = Carbon::parse($extra->created_at);
            $startDate = Carbon::parse($extra->date.' '.$extra->date_time);
            
            $timeLeft = $postDate->diffInSeconds($startDate);

            $postDate = $postDate->addSeconds($timeLeft/2);
            
            if(Carbon::now() >= $postDate)
            {
              $this->extraRepository->update($extra->id, ['open' => 1]);

              $students = Student::where('group', 2)->get();

              foreach ($students as $student) {

                $notif_to_send = 'The extra '.$extra->type.' for '.$extra->professional->company_name.' is available. See the link : '.route('show_extra', [$student->user->id, $extra->id]);

                $professionalUser = $extra->professional->user;

                Mail::send('mails.notification', ['notification' => $notif_to_send, 'user' => $student->user], function($message) use ($student){
                    $message->to($student->user->email)->subject('New notification ExtrasMe');
                });

              }
            }
        }
    }
}
