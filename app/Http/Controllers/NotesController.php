<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Notes;
use DateTime;
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
        $notes = $this->addInfoToNotes($notes);
        return response()->json(['data' => $notes]);
    }

    /**
     * Display a listing of sorted notes rankings.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ranking(Request $request): JsonResponse
    {
        $type = $request->input('type');
        $amount = $request->input('amount');
        switch($type) {
            default:
            case "all":
                $date = (new DateTime())->modify('-10 years');
                break;
            case "year":
                $date = (new DateTime())->modify('-1 year');
                break;
            case "month":
                $date = (new DateTime())->modify('-30 days');
                break;
            case "week":
                $date = (new DateTime())->modify('-7 days');
                break;
        }
        $notes = Notes::whereDate('created_at', '>=', $date)->withCount('likes')->orderBy("likes_count", "DESC")->limit((int)$amount)->get();
        $notes = $this->addInfoToNotes($notes);
        return response()->json(['data' => $notes]);
    }

    public function own(): JsonResponse
    {
        $userId = Auth::id();
        $notes = Notes::where('creator_id', '=', $userId)->get();
        $notes = $this->addInfoToNotes($notes);
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
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id): JsonResponse
    {
        $note = Notes::find($id);
        if($note == null) return response()->json(['note' => null, 'message' => 'Nie ma takiej uwagi!']);
        return response()->json(['note' => $this->addInfoToNotes([$note]), 'message' => '']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if(!Auth::check()) return response()->json(['message' => 'You should be logged in!']);
        if(Auth::user()->role != 1) { if(Auth::id() != Notes::find($id)->id) return response()->json(['message' => 'You should be logged in!']); }
        $note_id= Notes::find($id)->id;
        Notes::destroy($id);
        Likes::where('note_id', '=', $note_id)->delete();
        return response()->json(['message' => 'deleted']);
    }

    public function addInfoToNotes($notes) {
        foreach ($notes as $note) {
            $note->name = $note->user->name;
            $note->likes = Likes::where('note_id', '=', $note->id)->count();
            $note->liked = Likes::where('user_id', '=', Auth::id())->where('note_id', '=', $note->id)->count() > 0;
        }
        return $notes;
    }
}
