@extends('adminlte::page')

@section('title', 'Pengelolaan Brand')

@section('content_header')
    <h1 class="m-0 text-dark">Pengelolaan Brand</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Pengelolaan Brand') }} <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahBrandModal"><i class="fa fa-plus"></i>Tambah Data</button></div>
                <div class="card-body">
                    
                    <table id="table-data" class="table table-borderer">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>DESKRIPSI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach ($brands as $brand )
                                <tr class="tengahflex">
                                    <td style="padding-top: 10px">{{ $no++ }}</td>
                                    <td style="padding-top: 10px">{{ $brand->name }}</td>
                                    <td style="padding-top: 10px">{{ $brand->description }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <button type="button" id="btn-edit-brand" class="btn btn-success" data-toggle="modal" data-target="#editBrandModal" data-id="{{ $brand->id }}">edit</button>
                                          <button type="button" id="btn-delete-buku" class="btn btn-danger" data-toggle="modal" data-target="#deleteBrandModal" data-id="{{ $brand->id }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="tambahBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.brand.submit') }}" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="name">Nama Brand</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" class="form-control" name="description" id="description" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="padding: 5px 20px 5px 20px;">kirim!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit-name">Nama</label>
                <input type="text" class="form-control" name="name" id="edit-name" required>
              </div>
              <div class="form-group">
                <label for="edit-description">Deskripsi</label>
                <input type="text" class="form-control" name="description" id="edit-description" required>
              </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="edit-id">
            <!-- <input type="hidden" name="old_cover" id="edit-old-cover"> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 5px 20px 5px 20px;">Tutup</button>
            <button type="submit" class="btn btn-primary" style="padding: 5px 20px 5px 20px;">Update!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


@stop

@section('js')

<script>
  $(function(){

    $(document).on('click', '#btn-edit-brand', function(){
      let id = $(this).data('id');
      alert(id);
    //   $('#image-area').empty();

      let baseurl = "http://localhost:8000";

      $.ajax({
        type: "get",
        url: baseurl+'/admin/ajaxadmin/dataBrand/'+id,
        dataType: 'json',
        success: function(res){
          $('#edit-name').val(res.name);
          $('#edit-description').val(res.description);
        //   if(res.cover !==null){
        //     $('#image-area').append(
        //       "<img src='"+baseurl+"/storage/cover_buku/"+res.cover+"' width=200px'>"
        //     );
        //   }else{
        //     $('#image-area').append('[Gambar tidak tersedia]');
        //   }
        }


      });
    });

//     $(document).on('click', '#btn-delete-buku', function(){
//     let id = $(this).data('id');
//     let cover = $(this).data('cover');

//     $('#delete-id').val(id);
//     $('#delete-old-cover').val(cover);
//   });

  });

 
</script>


@stop