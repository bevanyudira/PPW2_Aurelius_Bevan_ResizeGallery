@extends('auth.layouts')

@section('content')


    @if (Session::has('pesan'))

    <div class="alert alert-success">{{ Session()->get('pesan'); }}</div>

    @endif

    <table class="table table-striped" border="1">
        <thead>
            <tr>
                <th>id</th>
                <th>Foto</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data_buku as $index => $buku)
            <tr>
                <td>{{ $index+1 }}</td>
                {{-- <td>
                    <img src="{{ route('buku.showphoto', ['filename' => $buku->photo ?? 'default']) }}" alt="" width="100px">

                </td> --}}
                <td>
                    {{-- <img src="{{ asset('storage/photos/' . $buku->photoTable) }}" alt="" width="100px"> --}}
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $buku->id }}">
                        <img src="{{ asset('storage/photos/' . $buku->photoTable) }}" class="img-thumbnail" alt="Thumbnail for {{ $buku->title }}">
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal{{ $buku->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $buku->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel{{ $buku->id }}">Book Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/photos/' . $buku->photo) }}" class="img-fluid rounded" alt="Image for {{ $buku->title }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>Rp. {{ number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                {{-- <td>{{ number format($buku->harga, 0, ',', ',') }}</td>
                <td>{{ $buku->tgl_terbit->format('d-m-Y') }}</td> --}}
                <td>
                    @if (Auth::user())
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>

                    <button class="btn btn-warning" onclick="window.location='{{ route('buku.show', $buku->id) }}'">
                        Edit
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{ $data_buku->links() }}</div>
    {{-- <div>
        <strong>Jumlah Buku: {{ $jumlah_buku }}</strong>
    </div> --}}


    @if (Auth::user())
    <button class="btn btn-primary float-end" onclick="window.location='{{ route('buku.create') }}'">
        Tambah Buku
    </button>
    @endif

    <h3>Jumlah Buku : {{$jumlah_buku}}</h3>
    <h3>Total Harga Semua Buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</h3>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection



