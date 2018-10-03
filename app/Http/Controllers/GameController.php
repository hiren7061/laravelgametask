<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Shows dashboard with all data
    public function index()
    {
        $gameData = Game::all();
        return \View::make('/dashboard')->with('data', $gameData);
    }

    // Show form for add new game
    public function create()
    {
        return \View::make('addGame');
    }

    // Insert new game detail
    public function store(Request $request)
    {
        $data = $request -> all();
        $data = array('game_details'=>json_encode($data));
        $data = implode(',', $data);

        $post = new Game;
        $post->game_details = $data;
        $post->save();
    }

    // Show dashboard with all data
    public function show(Game $game)
    {
        $data = Game::all();
        return \View::make('/dashboard')->with('data', $data);
    }

    // Show edit form with id
    public function edit($id)
    {
        $record = Game::where('id',$id)->first();
        return \View::make('/editGame')->with('record', $record);
    }

    // Update game using its id
    public function update(Request $request, Game $game)
    {
        $dataSet = $request -> all();
        $data = array('game_details'=>json_encode($dataSet['json']));
        $data = implode(',', $data);

        $post = new Game;
        $post->exists = true;
        $post->id = $dataSet['id'];
        $post->game_details = $data;
        $post->save();
    }

    // Delete game using its id
    public function destroy($id)
    {
        Game::destroy($id);
    }
}
