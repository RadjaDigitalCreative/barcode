@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Barcode Generator</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped" id="tableProduct">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Barcode</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('footer')
<script>
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: '{{session('success')}}',
        showConfirmButton: false,
        timer: 1500
    })
    @endif
    $(document).ready(function() {
        $('#tableProduct').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('barcode-generator.index') }}",
            columns: [{
                data: 'product',
                name: 'product'
            },
            {
                data: 'barcode',
                name: 'barcode'
            }
            ],

            dom: 'Bfrtip',
            buttons: [
            'print',
            
            ],
        });
    })

</script>
@endsection
