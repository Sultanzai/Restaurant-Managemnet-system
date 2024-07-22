<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .auth-container h2 {
            margin-bottom: 20px;
        }
        .auth-container .form-control:focus {
            box-shadow: none;
        }
        .btn-custom-register {
            background-color: #3d3d3d;
            color: #fff;
        }
        .btn-custom-register:hover {
            background-color: #242424;
            color: #fff;
        }
        .error-message {
            display: none;
            margin-bottom: 20px;
        }
        .no-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2 class="text-center">Restaurant Register</h2>
        <div id="register-error" class="alert alert-danger error-message"></div>
        <form method="POST" action="{{ route('register') }}" onsubmit="handleRegister(event)">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-custom-register">Register</button>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="no-link">Login</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function handleRegister(event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;
            const token = document.querySelector('input[name="_token"]').value;

            const response = await fetch('{{ route('register') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            });

            if (response.status === 200) {
                window.location.href = '/dashboard';
            } else {
                const error = await response.json();
                const errorMessage = document.getElementById('register-error');
                errorMessage.style.display = 'block';
                errorMessage.innerText = error.message || 'Registration failed. Please check your input and try again.';
            }
        }
    </script>
</body>
</html>
