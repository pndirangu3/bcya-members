@extends('layouts.admin')

@section('title', 'Member Profile')

@section('content')

    <div class="member-profile-page">

        <div class="card">

            <div class="header">
                <h1>BCYA Member Profile</h1>

                <div class="membership-no">
                    {{ $member->membership_no }}
                </div>
            </div>

            <div class="content">

                <div class="photo-section">

                    @if ($member->photo)
                        <img src="/storage/{{ $member->photo }}">
                    @endif

                    <div class="status"
                        style="background:{{ $member->status == 'Approved' ? 'green' : ($member->status == 'Rejected' ? 'red' : '#833556') }};">
                        {{ $member->status }}
                    </div>

                    @if ($member->fingerprint_template)
                        <div class="status" style="background:green; margin-top:10px;">
                            Fingerprint Captured
                        </div>
                    @else
                        <div class="status" style="background:#999; margin-top:10px;">
                            Fingerprint Not Captured
                        </div>
                    @endif
                </div>

                <div class="details">

                    <table>

                        <tr>
                            <td class="label">First Name</td>
                            <td>{{ $member->first_name }}</td>
                        </tr>

                        <tr>
                            <td class="label">Middle Name</td>
                            <td>{{ $member->middle_name }}</td>
                        </tr>

                        <tr>
                            <td class="label">Last Name</td>
                            <td>{{ $member->last_name }}</td>
                        </tr>

                        <tr>
                            <td class="label">Gender</td>
                            <td>{{ $member->gender }}</td>
                        </tr>

                        <tr>
                            <td class="label">Date of Birth</td>
                            <td>{{ $member->date_of_birth }}</td>
                        </tr>

                        <tr>
                            <td class="label">Age</td>
                            <td>{{ $member->age }} Years</td>
                        </tr>

                        <tr>
                            <td class="label">Phone</td>
                            <td>{{ $member->phone }}</td>
                        </tr>

                        <tr>
                            <td class="label">Email</td>
                            <td>{{ $member->email }}</td>
                        </tr>

                        <tr>
                            <td class="label">National ID</td>
                            <td>{{ $member->national_id }}</td>
                        </tr>



                        <tr>
                            <td class="label">Payam</td>
                            <td>{{ $member->payam }}</td>
                        </tr>

                        <tr>
                            <td class="label">Boma</td>
                            <td>{{ $member->boma }}</td>
                        </tr>

                    </table>

                </div>

            </div>

            <div class="buttons">

                <a href="/members/{{ $member->id }}/edit" class="btn">
                    Edit Member
                </a>

                <a href="/members/{{ $member->id }}/approve" class="btn">
                    Approve
                </a>

                <a href="/members/{{ $member->id }}/reject" class="btn">
                    Reject
                </a>

                <a href="{{ route('members.index') }}" class="btn">
                    <span>👥</span>
                    All Members
                </a>

            </div>

        </div>
    </div>
@endsection
