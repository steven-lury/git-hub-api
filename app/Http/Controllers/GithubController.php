<?php

namespace App\Http\Controllers;

use App\DTO\GithubDTO;
use App\Http\Resources\GithubCollection;
use App\Jobs\FetchAllRepositories;
use App\Models\Github;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class GithubController extends Controller
{
    const PER_PAGE = 500;
    private static string $url = 'https://api.github.com/search/repositories?q=php';

    public function runJob(): void
    {
        $page = 1;
        $githubPerPage = 30;
        $results = Http::acceptJson()->get(self::$url)->object();
        while(ceil($results->total_count/$githubPerPage) >= $page){
            FetchAllRepositories::dispatch($page);
            $page++;
        }
    }

    public function index(): GithubCollection
    {
        $repositories = Github::where('name', 'like', "%php%")
            ->orWhere('language', 'like', "%php%")
            ->simplePaginate(self::PER_PAGE);
        return new GithubCollection($repositories);
    }

    public function popular(): GithubCollection
    {
        $repositories = Github::where(function(Builder $q){
            $q->where('name', 'like', "%php%")
            ->orWhere(fn(Builder $q) => $q->where('language', 'like', "%php%"));
        })
        ->orderByDesc('stargazers_count')
            ->simplePaginate(self::PER_PAGE);
        return new GithubCollection($repositories);
    }

    public function activity(): GithubCollection
    {
        $repositories = Github::where('name', 'like', "%php%")
            ->orWhere('language', 'like', "%php%")
            ->orderByDesc('updated_at')
            ->simplePaginate(self::PER_PAGE);
        return new GithubCollection($repositories);
    }
}
