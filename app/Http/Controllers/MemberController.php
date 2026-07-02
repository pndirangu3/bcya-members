<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Payam;
use App\Models\Boma;
use Carbon\Carbon;


class MemberController extends Controller
{


    public function create()
    {

        $payams = Payam::orderBy('name')->get();

        return view('register', compact('payams'));
    }


    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 20);

        if (! in_array($perPage, [10, 20, 50, 100])) {
            $perPage = 20;
        }
        $search = $request->search;

        $members = Member::query()

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('membership_no', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('national_id', 'like', "%{$search}%");
                });
            })

            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            ->when($request->gender, function ($query) use ($request) {
                $query->where('gender', $request->gender);
            })

            ->when($request->payam, function ($query) use ($request) {
                $query->where('payam', $request->payam);
            })

            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_from);
            })

            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_to);
            })

            ->when($request->age_group, function ($query) use ($request) {

                [$minAge, $maxAge] = explode('-', $request->age_group);

                $youngest = Carbon::now()->subYears($minAge);

                $oldest = Carbon::now()->subYears($maxAge + 1)->addDay();

                return $query->whereBetween('date_of_birth', [
                    $oldest->toDateString(),
                    $youngest->toDateString()
                ]);
            });

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = [
            'membership_no',
            'first_name',
            'date_of_birth',
            'status',
            'created_at'
        ];

        if (! in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $members = $members
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        $payams = Payam::orderBy('name')->get();

        return view('members', compact('members', 'payams'));
    }


    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('member-profile', compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);

        $payams = Payam::orderBy('name')->get();

        $selectedPayam = Payam::where('name', $member->payam)->first();

        $bomas = [];

        if ($selectedPayam) {
            $bomas = Boma::where('payam_id', $selectedPayam->id)
                ->orderBy('name')
                ->get();
        }
        //dd($member);
        return view('edit-member', compact(
            'member',
            'payams',
            'bomas'
        ));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'nullable|string|max:255',
            'last_name'    => 'required|string|max:255',
            'gender'       => 'required',
            'date_of_birth' => 'required|date',
            'phone'        => 'required',
            'email'        => 'nullable|email',
            'national_id'  => 'required',
            'payam'        => 'required',
            'boma'         => 'required',
            'clan'         => 'nullable|string|max:255',
            'section'      => 'nullable|string|max:255',
        ]);

        $member->update($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'date_of_birth',
            'phone',
            'email',
            'national_id',
            'payam',
            'boma',
            'clan',
            'section'
        ]));

        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('photos', 'public');

            $member->photo = $photoPath;

            $member->save();
        }

        return redirect('/members/' . $member->id)
            ->with('success', 'Member updated successfully.');
    }

    public function store(Request $request)
    {


        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'fingerprint_template' => 'required',
                'date_of_birth' => [
                    'required',
                    'date',
                    'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
                    'after_or_equal:' . now()->subYears(46)->format('Y-m-d'),
                ],

                'phone' => 'required',
                'email' => 'required|email',
                'national_id' => 'required|unique:members',

                'payam' => 'required',
                'boma' => 'required',
                'clan' => 'required',
                'section' => 'required',

                'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ],
            [
                'date_of_birth.before_or_equal' => 'Member must be at least 18 years old.',
                'date_of_birth.after_or_equal'  => 'Member must not be older than 46 years.',
                'photo.required' => 'Member photo is required.',
                'email.email' => 'Please enter a valid email address.',
            ]
        );

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members', 'public');
        }


        $lastMember = Member::latest()->first();

        $nextId = $lastMember ? $lastMember->id + 1 : 1;

        $membershipNo = 'BCYA-' . date('Y') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $member = Member::create([
            'membership_no' => $membershipNo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'middle_name' => $request->middle_name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'national_id' => $request->national_id,
            'payam' => $request->payam,
            'boma' => $request->boma,
            'clan' => $request->clan,
            'section' => $request->section,
            'photo' => $photoPath,
            'fingerprint_template' => $request->fingerprint_template,
            'status' => 'Pending'
        ]);

        return redirect('/members/' . $member->id);
    }

    public function approve($id)
    {
        $member = Member::findOrFail($id);

        $member->status = 'Approved';

        $member->save();

        return back();
    }

    public function reject($id)
    {
        $member = Member::findOrFail($id);

        $member->status = 'Rejected';

        $member->save();

        return back();
    }
}
