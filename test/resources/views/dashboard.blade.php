<h2>Selamat Datang, {{ $user['user_name'] }}</h2>
<p>Email: {{ $user['user_email'] }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
