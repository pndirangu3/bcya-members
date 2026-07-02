@extends('layouts.bcya')

@section('title', 'Bor Community Youth Association')
@section('page-class', 'welcome-page')

@section('content')

@section('navbar')

    <a href="{{ route('login') }}">
        Admin Login
    </a>

    <a href="#about" class="btn secondary">
        Learn More
    </a>

@endsection

<div class="hero">

    <div class="left">

        <div class="left-content">

            <h1>

                Bor Community Youth Association

            </h1>

            <div class="motto">

                Unity • Peace • Development

            </div>

            <div class="description">

                Bor Community Youth Association (BCYA) in Juba is a Community Based
                Organization dedicated to empowering young people, promoting
                leadership, strengthening unity, and creating opportunities
                that improve the welfare of the Bor community through peace,
                development and active participation.

            </div>

            <div class="buttons">



                <a href="{{ route('login') }}" class="btn secondary">

                    Administrator Login

                </a>

            </div>

        </div>

    </div>

    <div class="right">

        <div class="logo-card">

            <img src="{{ asset('images/bcya-logo.jpg') }}" alt="BCYA Logo">

        </div>

    </div>

</div>



@endsection
