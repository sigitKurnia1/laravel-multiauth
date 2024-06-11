<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Sign In Form</title>
</head>
<body class="container">
    <div class="row mt-4">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Sign in</h5>
                <div class="card-body">
                <a class="btn btn-success mb-4 mt-3" href="{{ route('login-form') }}">Back</a>
                  <form action="{{ route('post-register') }}" method="POST">
                    @csrf
                    <label class="form-label">Name</label>
                    <input class="form-control mb-3" type="text" name="name" placeholder="Your fullname" required>
                    <label class="form-label">Email</label>
                    <input class="form-control mb-3" type="email" name="email" placeholder="Your email address" required>
                    <label class="form-label">Username</label>
                    <input class="form-control mb-3" type="text" name="username" placeholder="Your username" required>
                    <label class="form-label">Password</label>
                    <input class="form-control mb-3" type="password" name="password" placeholder="Your password" required>
                    <button class="btn btn-primary mt-3" type="submit">Sign In</button>
                  </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>