<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Notes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $notes = Notes::orderBy("created_at", "DESC")->get();
        foreach ($notes as $note) {
            $note->name = $note->user->name;
            $note->likes = Likes::where('note_id', '=', $note->id)->count();
            $note->liked = Likes::where('user_id', '=', Auth::id())->where('note_id', '=', $note->id)->count() > 0;
        }
        return response()->json(['data' => $notes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $id = Auth::id();
        $note = new Notes();
        $note->creator_id = $id;
        $note->content = htmlentities($request->input('content'));
        $note->save();

        return response()->json(['data' => $note, 'message' => '']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $note = Notes::find($id);
        return response()->json(['data' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $note_id= Notes::find($id)->id;
        Notes::destroy($id);
        Likes::where('note_id', '=', $note_id)->delete();
        return response()->json('deleted');
    }
}
