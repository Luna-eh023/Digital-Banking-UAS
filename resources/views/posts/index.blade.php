<h1>Daftar Post</h1>

<a href="{{ route('posts.create') }}">Buat Post Baru</a>
<br><br>

@if ($posts->isEmpty())
    <p>Belum ada post yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
        <th style="width: 50px">No</th>
        <th style="width: 300px">Judul</th>
        <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
@foreach($posts as $post)

<tr>
    <td style="text-align: center">{{ $loop->iteration }}</td>
    <td>
        <a href="{{ route('posts.show', $post) }}">
        {{ $post->title }}
        </a>
    </td>
    <td style="text-align: center">
        <a href="{{ route('posts.edit', $post) }}">Ubah</a>
        <form action="{{ route('posts.destroy', $post) }}" method="post"style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif