<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'when' => 'datetime',
        'status' => CompetitionStatus::class
    ];

    public function hostUni() {
        return $this->hasOne(University::class, 'id', 'host');
    }

    public function currentSeason() {
        return $this->hasOne(Season::class, 'id', 'season');
    }

    public function getResultsResource() {
        return $this->hasOne(Resource::class, 'id', 'results_resource');
    }

    public function hasResults() {
        return $this->results_resource ? true : false;
    }

    public function getStatus() {
        if (now() > $this->when) {
            return "competition-status-finished";
        } else {
            return "";
        }
    }


    
}

enum CompetitionStatus: string {
    case READY = 'ready';
    case FINISHED = 'finished';
    case AWAITING_RESULTS = 'awaiting_results';
    case INCOMPLETE_SETUP = 'incomplete_setup';

    public function toCSSStatus(): string {
        return match($this){
            CompetitionStatus::READY => 'competition-status-ready',
            CompetitionStatus::FINISHED => 'competition-status-finished',
            CompetitionStatus::AWAITING_RESULTS => 'competition-status-results',
            CompetitionStatus::INCOMPLETE_SETUP => 'competition-status-alert'
        };
    }

    public function toStatusMessage(): string {
        return match($this){
            CompetitionStatus::READY => 'This competition is ready to take place',
            CompetitionStatus::FINISHED => 'This competition is fully finished',
            CompetitionStatus::AWAITING_RESULTS => 'This competition still needs its results uploading!',
            CompetitionStatus::INCOMPLETE_SETUP => 'This competition has not been fully setup!'
        };
    }




    
}
