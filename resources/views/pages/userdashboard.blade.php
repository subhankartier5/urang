@extends('pages.layouts.user-master')
@section('content')
  <div class="main-content neighbour">
    <div class="container">
      <div class="row">
        <div class="col-md-8 dashboard">
            <h2 > Dashboard </h2>
            <div class="dash-section">
              <h3>New Pick-Up</h3>
              <p><a href="{{route('getPickUpReq')}}"></span><i class="fa fa-share" aria-hidden="true"></i> Schedule Pick-Up </a></p>
            </div>
            <div class="clear50"></div>
            <div class="dash-section">
              <h3>Current Pick-Ups</h3>
              @if(count($pick_up_req) == 0)
                <p>You currently have no scheduled pick-ups.</p>
              @else
                  <?php
                      $placed_order = 0;
                      $picked_up_order = 0;
                      $processed_order = 0;
                      $delivered_order =0;
                  ?>
                @foreach($pick_up_req as $req)
                  <?php
                    $order_status = $req->order_status;
                    switch ($order_status) {
                      case '1':
                        $placed_order++;
                        break;
                      case '2':
                         $picked_up_order++;
                        break;
                      case '3':
                         $processed_order++;
                        break;
                      case '4':
                         $delivered_order++;
                        break;
                      default:
                        echo "Something went wrong error!";
                        break;
                    }
                    //echo $placed_order;
                  ?>
                @endforeach
                <p>You currently have {{count($pick_up_req)}} total pick-ups.</p>
                <p>You currently have {{$placed_order}} scheduled pick-ups.</p>
                <p>You currently have {{$picked_up_order}} picked up orders.</p>
                <p>You currently have {{$processed_order}} processed pick-ups.</p>
                <p>You currently have {{$delivered_order}} total delivered pick-ups.</p>
              @endif
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