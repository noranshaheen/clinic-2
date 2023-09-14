<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Login</title>
</head>
<body class="bg-light">
    <div class="container w-25 mt-5 mx-auto bg-white p-4 border border-3 rounded-3">
        <h2 class="mb-5 text-center">
            Admin Login 
        </h2>
        <div>
          @if (session('error'))
              <div class="alert alert-danger p-3">
                  {{ session('error') }}
              </div>
          @endif
      </div>
        <form action="{{ route('login.store') }}" method="post">
          @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
    </div>
</body>
</html>