<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Decoratefarm;
use Carbon\Carbon;

class DailyDecorateBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:reorderdaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan Command Daily Decorate Bonus';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $player_count = Decoratefarm::groupBy('playerid')->count();
        //$deduct =  $player_count - 0;
        $data = $player_count +  $player_count;   
        $limit = $data - 10;

       $farm_update = Decoratefarm::whereIn('file_name', [1, 2, 3, 4, 5])->exists();
       $remove = Decoratefarm::where('file_name','Remove')->exists();
       if($remove){
         Decoratefarm::where('decorate_coin_status',1)->update(array('file_name' => null,'decorate_coin_status' => null));
       }

       
       if ($farm_update) {
           Decoratefarm::whereIn('file_name', [1, 2, 3, 4, 5])->update(array('file_name' => null));
           $decor_id_one = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $decor_id_two = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $decor_id_three = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $randone = rand(1, 5);
           $randtwo = rand(2, 4);
           $randthree = rand(1, 3);
           Decoratefarm::whereIn('id', $decor_id_one)->update(array('file_name' => $randone, 'decorate_coin_status' => null,));
           Decoratefarm::whereIn('id', $decor_id_two)->update(array('file_name' => $randtwo, 'decorate_coin_status' => null,));
           Decoratefarm::whereIn('id', $decor_id_three)->update(array('file_name' => $randthree, 'decorate_coin_status' => null,));
       }else{
           Decoratefarm::where('decorate_coin_status',1)->update(array('file_name' => null,'decorate_coin_status' => null));
           $decor_id_one = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $decor_id_two = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $decor_id_three = Decoratefarm::inRandomOrder()->limit($limit)->pluck('id')->toArray();
           $randone = rand(1, 5);
           $randtwo = rand(2, 4);
           $randthree = rand(1, 3);
           Decoratefarm::whereIn('id', $decor_id_one)->update(array('file_name' => $randone, 'decorate_coin_status' => null,));
           Decoratefarm::whereIn('id', $decor_id_two)->update(array('file_name' => $randtwo, 'decorate_coin_status' => null,));
           Decoratefarm::whereIn('id', $decor_id_three)->update(array('file_name' => $randthree, 'decorate_coin_status' => null,));
       }
      


    }
}
