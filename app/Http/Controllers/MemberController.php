<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Payam;

class MemberController extends Controller
{


    public function create()
    {

     $payams = Payam::orderBy('name')->get();

    return view('register', compact('payams'));
    }

	public function index()
{
    $members = Member::latest()->get();

    return view('members', compact('members'));
}


public function show($id)
{
    $member = Member::findOrFail($id);

    return view('member-profile', compact('member'));
}


    public function store(Request $request)
    {


	$request->validate([
    'first_name' => 'required',
    'last_name' => 'required',
    'gender' => 'required',

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
]);	

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
