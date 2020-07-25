@extends('layouts.app')

@section('title', 'FREE Ultimate Guide to CDA Interviews: Tips & Proven Strategies to Help You Prepare & Ace Your CDA Structured Interview.')

@section('content')
<!-- Header Section -->
<header class="masthead" style="background-image: url('{{ getHomePageImage()  }}');">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        <h1 class="font-weight-bold text-light">CDA Interview Guide</h1>
      </div>
    </div>
  </div>
</header>
<!-- End of Header Section -->

<!-- Main Content Section -->
<div class="container p-5">
{!! getHomePageHtml() !!}
</div>
<!-- End of Main Content Section -->
@endsection