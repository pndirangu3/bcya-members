@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <h1 class="dashboard-title">Dashboard</h1>

    <p class="dashboard-subtitle">
        Welcome back, {{ Auth::user()->name }}.
    </p>

    <div class="dashboard-cards">

        <div class="stat-card">
            <div class="stat-number">{{ $totalMembers }}</div>
            <div class="stat-label">Total Members</div>
        </div>

        <div class="stat-card">
            <div class="stat-number">{{ $pendingMembers }}</div>
            <div class="stat-label">Pending Approval</div>
        </div>

        <div class="stat-card">
            <div class="stat-number">{{ $approvedMembers }}</div>
            <div class="stat-label">Approved Members</div>
        </div>

        <div class="stat-card">
            <div class="stat-number">{{ $rejectedMembers }}</div>
            <div class="stat-label">Rejected Members</div>
        </div>

    </div>

    <div class="dashboard-cards">

        <div class="stat-card">
            <div class="stat-number">{{ $payams }}</div>
            <div class="stat-label">Payams</div>
        </div>

        <div class="stat-card">
            <div class="stat-number">{{ $bomas }}</div>
            <div class="stat-label">Bomas</div>
        </div>

        <div class="stat-card">
            <div class="stat-number">{{ $administrators }}</div>
            <div class="stat-label">Administrators</div>
        </div>

    </div>

@endsection
