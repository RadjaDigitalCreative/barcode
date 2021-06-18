@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
    @include('brand.create')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Brand</h3>
        </div>
        <div class="panel-body">
            <div style="margin-bottom: 15px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter9">+ Add Brand Owner</button>
            </div>
            <table class="table table-striped" id="tableBrand" cells pacing="0" width="100%">
                <thead>
                <tr>
                    <th>Brand</th>
                    <th>No. HP</th>
                    <th>Click Whatsapp</th>
                    <th>Created</th>
                    <th>Action</th>
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
                    window.location.href = '{!! url('brand/') !!}/'+id+'/delete';
                }
            })
        }
        $(document).ready(function() {
            $('#tableBrand').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ route('brand') }}",
                columns: [

                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'number_hp',
                        name: 'number_hp'
                    },
                    {
                        data: 'whatsapp',
                        name: 'whatsapp'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],

                dom: 'Bfrtip',
                buttons: [
                    'print'
                ],
            });
        })

    </script>
@endsection
