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
            <table class="table table-striped" id="tableProduct" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Print Barcode & QR Code</th>
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
        $(document).ready(function () {
            $('#tableProduct').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('/brand/barcode_generator') }}/'+id+'",
                columns: [
                    {
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
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
