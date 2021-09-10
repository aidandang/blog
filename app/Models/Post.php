<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post {
    public static function find($slug) {
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        $post = cache()->remember("posts.{$slug}", 5, function () use ($path) {
            return file_get_contents($path);
        });

        return $post;
    }
}
