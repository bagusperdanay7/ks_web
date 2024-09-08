<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Idol;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DashboardIdolController extends Controller
{
    final public const MAX_STRING_CHAR_VALIDATION = 'max:191';
    final public const DASHBOARD_IDOL_PATH = '/dashboard/idols';

    public function index()
    {
        $idol = Idol::orderBy('stage_name')->paginate(50)->withQueryString();

        if (request('search')) {
            $idol = Idol::where('stage_name', 'like', '%' . request('search') . '%')
                ->orWhere('birth_name', 'like', '%' . request('search') . '%')
                ->orderBy('stage_name')->paginate(50)->withQueryString();
        }

        return view('dashboard.idols.index', [
            'title' => 'Idols Table',
            'idols' => $idol,
        ]);
    }

    public function create()
    {
        return view('dashboard.idols.create', [
            'title' => 'Create Idol',
            'artists' => Artist::orderBy('artist_name')->where('classification', 'Singer')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'stage_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'birth_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'artist_id' => ['required'],
        ]);

        Idol::create($validateData);

        return redirect(self::DASHBOARD_IDOL_PATH)->with('success', 'New Idol has been created!');
    }

    public function show(Idol $idol)
    {
        return view('dashboard.idols.show', [
            'title' => $idol->stage_name,
            'idol' => $idol,
        ]);
    }

    public function edit(Idol $idol)
    {
        return view('dashboard.idols.edit', [
            'title' => 'Update Idol',
            'idol' => $idol,
            'artists' => Artist::orderBy('artist_name')->where('classification', 'Singer')->get()
        ]);
    }

    public function update(Request $request, Idol $idol)
    {
        $rules = [
            'stage_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'birth_name' => ['required', self::MAX_STRING_CHAR_VALIDATION],
            'artist_id' => ['required'],
        ];

        $validateData = $request->validate($rules);

        Idol::where('id', $idol->id)->update($validateData);

        return redirect(self::DASHBOARD_IDOL_PATH)->with('success', 'The Idol has been updated!');
    }

    public function destroy(Idol $idol)
    {
        try {
            Idol::destroy($idol->id);
            return redirect(self::DASHBOARD_IDOL_PATH)->with('success', 'The idol has been deleted!');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect(self::DASHBOARD_IDOL_PATH)->with('danger', 'Cannot delete this record because it is referenced in a related table. Please remove the related records before attempting to delete this one.');
            }
        }
    }
}
