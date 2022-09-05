<!DOCTYPE html>
<html>
<head>
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <br>
                <input type="file" name="file" class="form-control">
                <br>
                <button type="submit" class="btn btn-primary">Import Employees</button>
            </form>

            <table class="table table-bordered mt-3">
                <tr style="border: 0">
                    <th colspan="3" style="border: 0">
                      Employees
                    </th>
                    <th colspan="3" style="border: 0; text-align: right" >
                        <a href="{{url('/matches')}}" class="btn btn-success">Matches</a>
                    </th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Division</th>
                    <th>Age</th>
                    <th>UTC offset</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->division }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->utc_offset }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
</div>

</body>
</html>
