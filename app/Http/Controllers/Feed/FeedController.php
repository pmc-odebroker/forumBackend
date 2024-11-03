<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Feed;
use App\Models\Like;

class FeedController extends Controller
{
    public function store(PostRequest $request)
    {
        $request->validated();

        if (!auth()->check()) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $feed = auth()->user()->feeds->create([
            'content' => $request->content
        ]);

        return response([
            'message' => 'success',
            'feed' => $feed
        ]);
    }

    public function likePost($feed_id)
    {
        $feed = Feed::whereId($feed_id)->first();

        if(!$feed){
            return response([
                'message' => '404 Not Found'
            ], 404);
        }

        if($feed->user()->id == auth()->user()->id){
            Like::whereFeedId($feed_id)->delete();
            return response([
                'message' => 'feed Unliked'
            ], 200);
        }
        else
        {
            Like::create($feed_id);
            return response([
                'message' => 'Liked'
            ]);
        }
    }
}
