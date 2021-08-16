@extends ('template')

@section ('content')
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        @if (auth()->user()->role == "admin")
                        <a href="/tambah" class="btn btn-md btn-primary mb-3">[+] Tambah Data</a>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Content</th>
                                    @if (auth()->user()->role == "admin")
                                    <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/public/blogs/'. $blog->image) }}" alt="{{ $blog->image }}" class="rounded" style="width: 150px;">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{!! $blog->content !!}</td>
                                    @if (auth()->user()->role == "admin")
                                    <td>
                                        <form action="/delete{{ $blog->id }}" onsubmit="return confirm('Apakah anda yakin?')" method="POST">
                                            <a href="{{ route('edit', $blog->id) }}" class="btn btn-sm btn-success">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data belum tersedia
                                </div>
                                @endforelse
                            </tbody>
                            {{ $blogs->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    

    <script>
        //message with toastr
        @if(session() -> has('success'))

        toastr.success('{{ session('
            success ') }}', 'BERHASIL!');

        @elseif(session() -> has('error'))

        toastr.error('{{ session('
            error ') }}', 'GAGAL!');

        @endif
    </script>
@endsection