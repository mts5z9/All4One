

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'all4one') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">all4one Rewards</div>
                    <div class="panel-body">
                      <h3>Hi {{$reward['name']}},</h3>
                      <p>
                        You have used a reward from {{$reward['businessName']}}!
                      </p>
                    </div>
                    <div class="panel-body">
                      <h4>Reward Information</h4>
                      <li>Reward: {{$reward['title']}}</li>
                      <li>Description: {{$reward['descr']}}</li>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
