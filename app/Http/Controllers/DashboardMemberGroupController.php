<?php

namespace App\Http\Controllers;

use App\Enums\MemberStatus;
use App\Models\Artist;
use App\Models\Idol;
use Illuminate\Http\Request;
use Illuminate\Database\UniqueConstraintViolationException;

class DashboardMemberGroupController extends Controller
{
    final public const DASHBOARD_MEMBER_GROUP_PATH = '/dashboard/member-group';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Idol::with('groups')->orderBy('stage_name')->get();

        return view('dashboard.member_group.index', [
            'title' => 'Member Group Table',
            'memberGroup' => $member,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.member_group.create', [
            'title' => 'Create Member Group',
            'groups' => Artist::where('classification', 'Group')->orderBy('artist_name')->get(),
            'idols' => Idol::orderBy('stage_name')->get(),
            'statuses' => MemberStatus::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'status' => 'required',
            'idol_id' => 'required',
            'artist_id' => 'required',
        ]);

        $member = Idol::find($validateData['idol_id']);

        try {
            $member->groups()->attach($validateData['artist_id'],  ['status' => $validateData['status']]);
            return redirect(self::DASHBOARD_MEMBER_GROUP_PATH)->with('success', 'The Relation has been created!');
        } catch (UniqueConstraintViolationException) {
            return redirect(self::DASHBOARD_MEMBER_GROUP_PATH)->with('warning', 'This member has already associated with the group!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $member = Idol::find($id);

        $member->groups()->detach($request->artist_id);

        return redirect(self::DASHBOARD_MEMBER_GROUP_PATH)->with('success', 'The Relation has been deleted!');
    }
}
