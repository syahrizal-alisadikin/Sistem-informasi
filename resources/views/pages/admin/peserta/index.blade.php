@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
<main>
    <div class="container-fluid">
        
        <div class="card mb-4">
            <div class="card-header">
              {{-- <a href="{{ route('materi.create') }}" class="btn btn-success">Tambah Materi</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="orders-table" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>JK</th>
                                <th>Umur</th>
                                <th>TB/BB</th>
                                <th>Kelas</th>
                                <th>Durasi</th>
                                <th>Kedatangan</th>
                                <th>Instruktur</th>
                                
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($peserta as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->peserta->user->name }}</td>
                                    <td>{{ $item->peserta->user->jenis_kelamin =="Laki Laki" ? 'L' : 'P' }}</td>
                                    <td>{{ $item->peserta->user->umur }}</td>
                                    <td>{{ $item->peserta->user->tinggi_badan ?? '-' }}/{{ $item->peserta->user->berat_badan ?? '-' }}</td>
                                    <td>{{ $item->peserta->kelas->name  ?? '-'}}</td>
                                    <td>{{ $item->peserta->durasi }}Hr</td>
                                    <td>{{ $item->peserta->kedatangan }} </td>
                                    <td>{{ $item->peserta->kelas->instruktur->name ?? '-' }} </td>
                                    <td>
                                         <a href="{{ route('peserta.edit' , $item->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum ada data</td>
                                </tr>
                                @endforelse
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("peserta.index") }}/"+id,
                        data:     {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@endsection