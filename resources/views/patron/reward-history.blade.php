@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Reward History</div>

                <div class="panel-body table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <tr>
                      <th>Business</th>
                      <th>Reward</th>
                      <th>Points Spent</th>
                      <th>Date</th>
                      <th>Time</th>
                    </tr>
                    <!--populate from database -->
                    <tr>
                      <th>Rose Music Hall</th>
                      <th>Free Drink</th>
                      <th>8pts.</th>
                      <th>8/15/2017</th>
                      <th>5:58pm</th>
                    </tr>
                    <tr>
                      <th>Sparkys</th>
                      <th>Free Scoop</th>
                      <th>10pts.</th>
                      <th>8/19/2017</th>
                      <th>7:34pm</th>
                    </tr>
                    <tr>
                      <th>Trops</th>
                      <th>1 Dollar Drink</th>
                      <th>6pts.</th>
                      <th>8/25/2017</th>
                      <th>8:13pm</th>
                    </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
