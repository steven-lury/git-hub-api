<?php

namespace App\DTO;

use Carbon\Carbon;

class GithubDTO extends BaseDTO
{
    public function __construct(
        public int    $github_id       ,
        public string $name            ,
        public string $full_name       ,
        public string $html_url        ,

        public string $pushed_at       ,
        public string $updated_at      ,
        public int    $stargazers_count,
        public ?string $language = null,
    )
    {}

    public static function fromResponse(object $result): static
    {
        return new static(
            github_id       : $result->id,
            name            : $result->name,
            full_name       : $result->full_name,
            html_url        : $result->html_url,
            pushed_at       : Carbon::parse($result->pushed_at)->format('Y-m-d H:i:s'),
            updated_at      : Carbon::parse($result->updated_at)->format('Y-m-d H:i:s'),
            stargazers_count: $result->stargazers_count ?? 0,
            language        : $result->language ?? 'unknown'
        );
    }
}
