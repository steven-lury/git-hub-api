<?php

namespace App\Jobs;

use App\DTO\GithubDTO;
use App\Models\Github;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchAllRepositories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private static string $url = 'https://api.github.com/search/repositories?q=php';

    public function __construct(
        private int $page
    ){}

    /**
     * Execute the job.
     */
    public function handle()
    {
        $results = Http::withOptions([
            'synchronous' => true,
            'delay' => 100
        ])
        ->acceptJson()
        ->get(self::$url.'&page='.$this->page)->object();
        if(empty($results->items)){
            Log::debug('items ===== '.$results);
        }else{
            foreach($results->items as $github) {
                Github::create(GithubDTO::fromResponse($github)->toArray());
            }
        }

    }
}
