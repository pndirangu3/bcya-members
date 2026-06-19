<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCYA Members</title>
    <style>
        /* Global Reset & Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.5;
            padding: 40px;
        }

        /* Container Card */
        .table-container {
            background-color: #ffffff;
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-top: 6px solid #833556;
        }

        h1 {
            color: #1e293b;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        /* Responsive Wrapper to allow horizontal scrolling only inside the table box */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: inset 0 0 4px rgba(0,0,0,0.02);
        }

        /* Modernized Table Layout */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
            white-space: nowrap; /* Prevents awkward multi-line text wrapping inside cells */
        }

        /* Sticky Headers with Primary Accents */
        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 14px 18px;
            border-bottom: 2px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
        }

        /* Row Layouts and Hover Interactions */
        td {
            padding: 14px 18px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:nth-child(even) {
            background-color: #f8fafc; /* Zebra striping */
        }
        tr:hover {
            background-color: #f1f5f9; /* Row highlighting */
        }

        /* Image Avatar Improvements */
        .avatar-container {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f5f9;
            border: 2px solid #e2e8f0;
        }
        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .avatar-placeholder {
            font-size: 18px;
            color: #94a3b8;
        }

        /* Dynamic Status Badge */
        .badge-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            background-color: rgba(131, 53, 86, 0.1);
            color: #833556;
            border: 1px solid rgba(131, 53, 86, 0.2);
        }

        /* Mobile Spacing Fixes */
        @media (max-width: 640px) {
            body {
                padding: 16px;
            }
            .table-container {
                padding: 16px;
            }
        }
    </style>
</head>
<body>

<div class="table-container">
    <h1>Registered Members</h1>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Membership No</th>
                    <th>Full Name</th> <!-- Combined names logistically in headers for cleaner presentation -->
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>National ID</th>
                    <th>County</th>
                    <th>Payam</th>
                    <th>Boma</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td style="font-weight: 600; color: #64748b;">#{{ $member->id }}</td>
                    
                    <td>
                        <div class="avatar-container">
                            @if($member->photo)
                                <img src="/storage/{{ $member->photo }}" alt="Member Photo">
                            @else
                                <span class="avatar-placeholder">👤</span>
                            @endif
                        </div>
                    </td>

                    <td style="font-weight: 500;">{{ $member->membership_no }}</td>
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
                    <td>{{ $member->county }}</td>
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
</div>

</body>
</html>
