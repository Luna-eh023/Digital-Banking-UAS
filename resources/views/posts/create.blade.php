<h1>Buat Post Baru</h1>
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    Judul:
    <br>
    <input name="title" required>
    <br>
    <br>
    Konten:
    <br>
    <textarea name="content" rows="8" required></textarea>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>