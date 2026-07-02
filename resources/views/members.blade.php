@extends('layouts.admin')

@section('title', 'BCYA Members')

@section('content')
    <div class="members-page">
        <div class="table-container">
            <h1>Registered Members</h1>
            <div class="members-toolbar">

                <div></div>

                <div class="members-toolbar-right">

                    <form method="GET" id="perPageForm">

                        {{-- Preserve filters --}}
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="gender" value="{{ request('gender') }}">
                        <input type="hidden" name="payam" value="{{ request('payam') }}">
                        <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                        <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                        <input type="hidden" name="age_group" value="{{ request('age_group') }}">

                        <label>Show</label>

                        <select name="per_page" onchange="document.getElementById('perPageForm').submit()">

                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page', 20) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>

                        </select>

                        <span>rows</span>

                    </form>

                </div>

            </div>
            <div class="table-actions">

                <form method="GET" id="perPageForm">

                    <input type="text" name="search" placeholder="Search member..." value="{{ request('search') }}">

                    <select name="status">
                        <option value="">Status</option>
                        <option value="Approved" {{ request('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

                    <select name="gender">
                        <option value="">Gender</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>

                    <select name="payam">
                        <option value="">Payam</option>

                        @foreach ($payams as $payam)
                            <option value="{{ $payam->name }}" {{ request('payam') == $payam->name ? 'selected' : '' }}>

                                {{ $payam->name }}

                            </option>
                        @endforeach

                    </select>

                    <input type="date" name="date_from" value="{{ request('date_from') }}" title="Registered From">

                    <input type="date" name="date_to" value="{{ request('date_to') }}" title="Registered To">

                    <select name="age_group">

                        <option value="">Age</option>

                        <option value="18-25" {{ request('age_group') == '18-25' ? 'selected' : '' }}>18–25</option>
                        <option value="26-30" {{ request('age_group') == '26-30' ? 'selected' : '' }}>26–30</option>
                        <option value="31-35" {{ request('age_group') == '31-35' ? 'selected' : '' }}>31–35</option>
                        <option value="36-40" {{ request('age_group') == '36-40' ? 'selected' : '' }}>36–40</option>
                        <option value="41-46" {{ request('age_group') == '41-46' ? 'selected' : '' }}>41–46</option>

                    </select>

                    <button type="submit">Apply</button>

                    <a href="{{ route('members.index') }}" class="btn-reset">
                        Reset
                    </a>

                </form>

            </div>
            <div class="table-responsive">
                @php
                    function sortLink($column)
                    {
                        $direction = request('sort') == $column && request('direction') == 'asc' ? 'desc' : 'asc';

                        return request()->fullUrlWithQuery([
                            'sort' => $column,
                            'direction' => $direction,
                        ]);
                    }

                    function sortIcon($column)
                    {
                        if (request('sort') != $column) {
                            return '↕';
                        }

                        return request('direction') == 'asc' ? '▲' : '▼';
                    }
                @endphp
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>
                                <a href="{{ sortLink('membership_no') }}">
                                    Membership No {{ sortIcon('membership_no') }}
                                </a>
                            </th>
                            <th>
                                <a href="{{ sortLink('first_name') }}">
                                    Full Name {{ sortIcon('first_name') }}
                                </a>
                            </th>
                            <th>Gender</th>
                            <th>
                                <a href="{{ sortLink('date_of_birth') }}">
                                    Date of Birth {{ sortIcon('date_of_birth') }}
                                </a>
                            </th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>National ID</th>
                            <th>Payam</th>
                            <th>Boma</th>
                            <th>
                                <a href="{{ sortLink('status') }}">
                                    Status {{ sortIcon('status') }}
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr class="clickable-row" data-href="{{ url('/members/' . $member->id) }}">
                                <td class="member-id">#{{ $member->id }}</td>

                                <td>
                                    <div class="avatar-container">
                                        @if ($member->photo)
                                            <img src="/storage/{{ $member->photo }}" alt="Member Photo">
                                        @else
                                            <span class="avatar-placeholder">👤</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="membership-no">{{ $member->membership_no }}</td>
                                <td>
                                    <strong>{{ $member->first_name }}</strong>
                                    {{ $member->middle_name }}
                                    <strong>{{ $member->last_name }}</strong>
                                </td>
                                <td>{{ $member->gender }}</td>
                                <td>{{ $member->date_of_birth }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->national_id }}</td>

                                <td>{{ $member->payam }}</td>
                                <td>{{ $member->boma }}</td>
                                <td>
                                    <span class="badge-status">
                                        {{ $member->status ?? 'Active' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="members-pagination">

                <div class="pagination-info">

                    Showing

                    <strong>{{ $members->firstItem() }}</strong>

                    to

                    <strong>{{ $members->lastItem() }}</strong>

                    of

                    <strong>{{ $members->total() }}</strong>

                    members

                </div>

                {{ $members->links() }}

            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.clickable-row').forEach(function(row) {

                row.addEventListener('click', function(e) {

                    // Don't trigger when clicking a button or link
                    if (e.target.closest('a') || e.target.closest('button')) {
                        return;
                    }

                    window.location = this.dataset.href;

                });

            });

        });
    </script>
@endsection
