<!DOCTYPE html>
<html>
<head>
    <title>BCYA Member Profile</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            margin:0;
            padding:30px;
        }

        .card{
            max-width:1000px;
            margin:auto;
            background:#ffffff;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.15);
        }

        .header{
            background:#833556;
            color:white;
            padding:20px;
        }

        .header h1{
            margin:0;
        }

        .membership-no{
            font-size:20px;
            font-weight:bold;
            margin-top:8px;
        }

        .content{
            display:flex;
            padding:25px;
            gap:30px;
        }

        .photo-section{
            width:250px;
            text-align:center;
        }

        .photo-section img{
            width:220px;
            border-radius:10px;
            border:4px solid #833556;
        }

        .status{
            margin-top:15px;
            display:inline-block;
            padding:8px 15px;
            background:#833556;
            color:white;
            border-radius:20px;
            font-weight:bold;
        }

        .details{
            flex:1;
        }

        .details table{
            width:100%;
            border-collapse:collapse;
        }

        .details td{
            padding:10px;
            border-bottom:1px solid #ddd;
        }

        .label{
            font-weight:bold;
            width:220px;
            color:#833556;
        }

        .buttons{
            padding:20px;
            border-top:1px solid #ddd;
        }

        .btn{
            display:inline-block;
            padding:10px 18px;
            background:#833556;
            color:white;
            text-decoration:none;
            border-radius:5px;
            margin-right:10px;
        }

        .btn:hover{
            opacity:0.9;
        }

    </style>
</head>
<body>

<div class="card">

    <div class="header">
        <h1>BCYA Member Profile</h1>

        <div class="membership-no">
            {{ $member->membership_no }}
        </div>
    </div>

    <div class="content">

        <div class="photo-section">

            @if($member->photo)
                <img src="/storage/{{ $member->photo }}">
            @endif

            <div class="status" style="
background:
{{ $member->status == 'Approved' ? 'green' :
   ($member->status == 'Rejected' ? 'red' : '#833556') }};
"  >
                {{ $member->status }}
            </div>

@if($member->fingerprint_template)
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
                    <td class="label">County</td>
                    <td>{{ $member->county }}</td>
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

	<a href="/members/{{ $member->id }}/approve"
class="btn">
Approve
</a>

<a href="/members/{{ $member->id }}/reject"
class="btn">
Reject
</a>

        <a href="/members" class="btn">
            All Members
        </a>

        <a href="/register" class="btn">
            Register New Member
        </a>

    </div>

</div>

</body>
</html>
