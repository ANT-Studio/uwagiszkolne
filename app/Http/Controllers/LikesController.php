<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $likes = Likes::all();
        foreach ($likes as $like) { $like->user_id = $like->user->id; $like->note_id = $like->note->id; }
        return response()->json(['data' => $likes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $note_id = $request->input('note_id');
        $id = Auth::id();
        if(Likes::where('user_id', '=', Auth::id())->where('note_id', '=', $note_id)->count() == 0){
            $like = new Likes();
            $like->user_id = $id;
            $like->note_id = $note_id;
            try {
                $like->saveOrFail();
            } catch (\Throwable $e) {
                return response()->json(['message' => $e]);
            }

            return response()->json(['message' => 'added']);
        }else{
            Likes::where('user_id', '=', Auth::id())->where('note_id', '=', $note_id)->delete();
            return response()->json(['message' => 'deleted']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Likes::destroy($id);
        return response()->json(['message' => '']);
    }
}
