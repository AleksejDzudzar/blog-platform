<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getPostsByTag(Tag $tag, int $perPage = 10)
    {
        return $tag->posts()->paginate($perPage);
    }
}
