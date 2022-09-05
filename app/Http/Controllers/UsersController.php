<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Matched;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Importer;

class UsersController extends Controller
{
    private $importer;

    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $users = User::all();

        return view('users', compact('users'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xls|max:2048'
        ]);
        $import = $this->importer->import(new UsersImport, $request->file);
        if($import){
            $users = User::all();

            foreach ($users as $user){
                $matchingUsers = User::where('id', '!=', $user->id)->get();

                foreach ($matchingUsers as $matchingUser){
                    if($matchingUser->division == $user->division){
                        $this->matching('division', $user, $matchingUser);
                    }
                    if($matchingUser->utc_offset == $user->utc_offset){
                        $this->matching('utc_offset', $user, $matchingUser);
                    }
                    if(abs($matchingUser->age - $user->age) <= 5){
                        $this->matching('age', $user, $matchingUser);
                    }
                }

            }
        }
        return redirect('/');
    }

    public function matching($condition, $user, $matchingUser)
    {
        $scores = [
            'division' => 30,
            'age' => 30,
            'utc_offset' => 40
        ];
        $key = 'matched_by_' . $condition;

        $matched = Matched::where('matched_emails', 'like', '%' . $matchingUser->email . '%')
            ->where('matched_emails', 'like', '%' . $user->email . '%')->first();
        if($matched){
            if($matched->$key == 0){
                $matched->score += $scores[$condition];
                $matched->$key = 1;
            }

        } else {
            $matched = new Matched();
            $matched->matched_emails = [$user->email, $matchingUser->email];
            $matched->matched_names = [$user->name, $matchingUser->name];
            $matched->score = $scores[$condition];
            $matched->$key = 1;
        }
        $matched->save();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function matches()
    {
        $matches = Matched::orderBy('score', 'DESC')->get();

        return view('matches', compact('matches'));
    }
}
