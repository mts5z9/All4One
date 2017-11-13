@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Scans</div>

                <div class="panel-body table-responsive">
                  <div id="pop_div"></div>
                  <?= $lava->render('LineChart', 'Rewards', 'pop_div') ?>
                </div>
                <div class="panel-body">
                  <a href="/rewardStats/year" class="btn btn-info">Past Year</a>
                  <a href="/rewardStats/month" class="btn btn-info">Past Month</a>
                  <a href="/rewardStats/week" class="btn btn-info">Past Week</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
