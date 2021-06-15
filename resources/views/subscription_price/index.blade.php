@extends('layouts.master')
@section('title')Add User @endsection
@section('header')
<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Menu Harga</h3>
    </div>
    <div class="panel-body">
        <table id="payment_list" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Bulan</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Menu Harga</h3>
    </div>
    <div class="panel-body">
        <form action="{{ route('subcription-price.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="jumlah_bulan">Jumlah Bulan</label>
                <input type="number" name="jumlah_bulan" value="{{ old('jumlah_bulan') }}" class="form-control"
                id="bulan" placeholder="Bulan">
                @if ($errors->has('jumlah_bulan'))
                <span class="help-block">{{ $errors->first('jumlah_bulan') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Harga Total</label>
                <input type="number" name="harga_total" value="{{ old('harga_total') }}" class="form-control"
                id="harga">
                @if ($errors->has('harga_total'))
                <span class="help-block">{{ $errors->first('jumlah_bulan') }}</span>
                @endif
            </div>
            <a class="btn btn-danger" id="reset">Reset</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
@section('footer')
<script>
    function confirmationDelte(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let data = id
                window.location.href = '/subcription-price/'+id+'/delete'
            }
        })
    }
    $(document).ready(function() {
        $('#reset').click(function() {
            $('#bulan').val(" ")
            $('#harga').val(" ")
        })
        $('#payment_list').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('subcription-price.index') }}",
            columns: [{
                data: 'month',
                name: 'month',
                render: function(data, type) {
                    if (type === 'display') {
                        return data + ' Bulan'
                    } else {
                        return data
                    }
                }
            },
            {
                data: 'price',
                name: 'price',
                render: function(data, type) {
                    if (type === 'display') {
                        var symbol = "Rp. ";
                        var num = $.fn.dataTable.render.number(',', '.', 2, symbol).display(
                            data);
                        if (num == null || num == 0) {
                            return 'Rp. 0'
                        } else {
                            return num;
                        }
                    } else {
                        return data;
                    }
                }
            },
            {
                data: 'action',
                name: 'action'
            },
            ]
        });
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        })
        @endif
    })

</script>
@endsection
