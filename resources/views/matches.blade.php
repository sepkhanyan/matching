<!DOCTYPE html>
<html>
<head>
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="mt-4">
        <a href="{{url('/')}}" class="btn btn-primary">Back</a>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <h2>Matches</h2>
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Pair</th>
                    <th>Score</th>
                </tr>
                @foreach($matches as $match)
                    <tr>
                        <td>{{ $match->matched_names[0] }}, {{ $match->matched_names[1] }}</td>
                        <td>{{ $match->score }} %</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>

</body>
</html>
