<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    public function show(Tag $tag)
    {
        // Prikazivanje postova sa određenim tagom
        $posts = $tag->posts;  // Pretpostavljamo da je relacija postavljena u Tag modelu

        return redirect()->route('tags.show', ['tag' => $tag]);
    }
}
