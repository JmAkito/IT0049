@extends('layout')
@section('title', 'About')
@section('content')
<div class="heading"><div><h1>About this POS</h1><p class="sub">A Laravel point-of-sale app for staff, inventory, customers, and transactions.</p></div></div>
<div class="card pad"><h2 style="margin-top:0">Project overview</h2><p>This application uses Laravel MVC, Eloquent relationships, server-side validation, authenticated routes, and a relational database. Sale creation runs inside a transaction and only completes when stock is available.</p><h2>Data relationships</h2><ul><li>One product can appear in many sales.</li><li>A customer may have many sales; customer selection is optional.</li><li>A staff user records many sales.</li><li>Deleting a customer leaves previous sales intact with a walk-in/unknown customer display.</li><li>Products and staff with sales are retained to preserve transaction history.</li></ul><p><a href="{{ route('dashboard') }}">Return to dashboard →</a></p></div>
@endsection
