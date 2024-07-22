<!-- resources/views/layouts/header.blade.php -->
<header>
    <h1>Dashboard</h1>
    <div class="user-info">
        <p>Welcome <span id="username">{{ Auth::user()->name }}</span></p>
    </div>
</header>
