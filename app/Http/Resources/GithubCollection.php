<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GithubCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return Arrayable
     */
    public function toArray(Request $request): Arrayable
    {
        return $this->collection->map(function ($github) {
            return [
                'id'               => $github->github_id,
                'name'             => $github->name,
                'full_name'        => $github->full_name,
                'html_url'         => $github->html_url,
                'language'         => $github->language,
                'pushed_at'        => $github->pushed_at,
                'updated_at'       => $github->updated_at,
                'stargazers_count' => $github->stargazers_count
            ];
        });
    }
}
