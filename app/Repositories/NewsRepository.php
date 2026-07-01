<?php

namespace App\Repositories;

use App\Models\NewsModel;
use Illuminate\Http\Request;

class NewsRepository
{
    public function GetListNews(Request $Request)
    {
        $query = NewsModel::query();

        if ($Request->filled('search')) {
            $query->where('title', 'like', '%' . trim($Request->search) . '%');
        }

        if ($Request->filled('status')) {
            $query->where('status', $Request->status);
        }

        $perPage = $Request->get('per_page', 10);

        return $query->orderByDesc('id')->paginate($perPage);
    }

    public function GetDetailNews(string $id)
    {
        return NewsModel::find($id);
    }

    public function insertNews(Request $Request)
    {
        return NewsModel::create([
            'title' => $Request->title,
            'content' => $Request->content,
            'image' => $Request->image,
            'author' => $Request->author,
            'status' => $Request->status ?? 'active',
        ]);
    }

    public function UpdateNews(Request $Request, string $id)
    {
        $news = NewsModel::find($id);

        if (!$news) {
            return null;
        }

        $news->update([
            'title' => $Request->title ?? $news->title,
            'content' => $Request->content ?? $news->content,
            'image' => $Request->image ?? $news->image,
            'author' => $Request->author ?? $news->author,
            'status' => $Request->status ?? $news->status,
        ]);

        return $news->fresh();
    }

    public function DeleteNews(string $id)
    {
        $news = NewsModel::find($id);

        if (!$news) {
            return false;
        }

        return $news->delete();
    }
}
