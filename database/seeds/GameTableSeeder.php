<?php

use Illuminate\Database\Seeder;
use App\Game;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $game = new Game();
        $game->game_details = '{"Game_Name":"Call Of Duty","Win_Rate":"197","Credits":"2100"}';
        $game->save();
    }
}
