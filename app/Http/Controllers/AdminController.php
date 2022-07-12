<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Season;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {


        $uniCount = University::count();

        $count = [
            'uni' => University::count(),
            'user' => User::count(),
            'competition' => Competition::count()
        ];

        return view('admin.index', ['count' => $count, 'currentSeason' => Season::current()]);


    }

    public function viewSeasons() {
        return view('admin.seasons.index', ['seasons' => Season::orderBy('from', 'desc')->paginate(10)]);
    }

    public function viewSeason(Season $season) {
        return view('admin.seasons.view', ['season' => $season]);
    }

    public function viewCompetitions() {
        return view('admin.competitions.index', ['competitions' => Competition::orderBy('when', 'desc')->paginate(10)]);
    }

    public function viewCompetition(Competition $competition) {
        return view('admin.competitions.view', ['competition' => $competition]);
    }

    public function viewUniversities() {
        return view('admin.universities.index', ['universities' => University::orderBy('name')->paginate(10)]);
    }

    public function viewUniversity(University $university) {
        return view('admin.universities.view', ['university' => $university]);
    }

    public function viewUsers() {
        return view('admin.users.index', ['users' => User::orderBy('name')->paginate(10)]);
    }
}
