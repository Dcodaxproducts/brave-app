<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'language', 'source', 'category', 'keywords', 'page_id', 'url', 'content'];

    public static function createFromNotion($title, $author, $language, $source, $category, $keywords, $pageId, $url, $content_data)
    {
        return self::create([
            'title' => $title,
            'author' => $author,
            'language' => $language,
            'source' => $source,
            'category' => $category,
            'keywords' => $keywords,
            'page_id' => $pageId,
            'url' => $url,
            'content' => $content_data,
        ]);
    }
}
