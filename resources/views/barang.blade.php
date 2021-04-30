@extends('adminlte::page')

@section('title', 'Pengelolaan Barang')

@section('content_header')
    <h1 class="m-0 text-dark">Pengelolaan Barang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Pengelolaan Barang') }} <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahBarangModal"><i class="fa fa-plus"></i>Tambah Data</button></div>
                <div class="card-body">
                    
                    <table id="table-data" class="table table-borderer">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>QTY</th>
                                <th>BRANDS_ID</th>
                                <th>CATEGORIES_ID</th>
                                <th>PHOTO</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach ($barang as $bar )
                                <tr class="tengahflex">
                                    <td style="padding-top: 10px">{{ $no++ }}</td>
                                    <td style="padding-top: 10px">{{ $bar->name }}</td>
                                    <td style="padding-top: 10px">{{ $bar->qty }}</td>
                                    <td style="padding-top: 10px">{{ $bar->brands_id }}</td>
                                    <td style="padding-top: 10px">{{ $bar->categories_id }}</td>
                                    <td>
                                        @if ($bar->photo !== null)
                                            <div class="coverdiv" style="max-height:60px; max-width:60px; overflow:hidden; text-align:center;"><img src="{{ asset('storage/photo_barang/'.$bar->photo) }}" alt="{{ $bar->name }}" height='60'></div>
                                        @else
                                            [Gambar tidak tersedia]
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <button type="button" id="btn-edit-barang" class="btn btn-success" data-toggle="modal" data-target="#editBarangModal" data-id="{{ $bar->id }}">edit</button>
                                          <button type="button" id="btn-delete-barang" class="btn btn-danger" data-toggle="modal" data-target="#deleteBarangModal" data-id="{{ $bar->id }}">Hapus</button>
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


<div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('user.barang.submit') }}" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="name">Nama Barang</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="form-group">
            <label for="qty">Qty</label>
            <input type="number" class="form-control" name="qty" id="qty" required>
          </div>
         
          <div class="form-group">
            <label class="font-noraml">
                Brands_Id
            </label>
            <div class="input-group">
                <select data-placeholder="Select a grade..." class="form-control chosen-select" style="width:350px;" tabindex="2" name="brands_id">
                <option value="">
                </option>
                @foreach ($brands as $brand )
                <option value="{{ $brand->id }}">{{ $brand->id }} {{ $brand->name }}</option>
                @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label class="font-noraml">
                Categories_Id
            </label>
            <div class="input-group">
                <select data-placeholder="Select a grade..." class="form-control chosen-select" style="width:350px;" tabindex="2" name="categories_id">
                <option value="">
                </option>
                @foreach ($categories as $category )
                <option value="{{ $category->id }}">{{ $category->id }} {{ $category->name }}</option>
                @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" name="photo" id="photo" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="padding: 5px 20px 5px 20px;">kirim!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('js')

<script>
  $(document).ready(function() {
  $('#myModal').on('show.bs.modal', function(e) {
    console.debug('modal shown!');
    $('.chosen-select', this).chosen({width: "350px"});
  });

  $("#myModal").modal('show');
});

 
</script>


@stop