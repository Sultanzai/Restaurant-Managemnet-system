<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-decoration: none; /* Remove underline */
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container .form-control:focus {
            box-shadow: none;
        }
        .btn-custom {
            background-color: #2d2d2d;
            color: #fff;
        }
        .error-message {
            display: none;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Restaurant Login</h2>
        <div id="login-error" class="alert alert-danger error-message"></div>
        <form method="POST" action="{{ route('login') }}" onsubmit="handleLogin(event)">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Login</button>
            </div>
            <br>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const token = document.querySelector('input[name="_token"]').value;

            const response = await fetch('{{ route('login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ email, password })
            });

            if (response.status === 200) {
                window.location.href = '/dashboard';
            } else {
                const error = await response.json();
                const errorMessage = document.getElementById('login-error');
                errorMessage.style.display = 'block';
                errorMessage.innerText = error.message || 'Login failed. Please check your credentials and try again.';
            }
        }
    </script>
</body>
</html>
