@extends('pages.layouts.user-master')
@section('content')
  <div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8 dashboard">
            <h2 > Dashboard </h2>
            <div class="dash-section">
              <h3>New Pick-Up</h3>
              <p><a href="#"></span><i class="fa fa-share" aria-hidden="true"></i> Schedule Pick-Up </a></p>
            </div>
            <div class="clear50"></div>
            <div class="dash-section">
              <h3>Current Pick-Ups</h3>
              <p>You currently have no scheduled pick-ups.</p>
            </div>
        </div>
      </div>
    </div>
  </div>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
@endsection