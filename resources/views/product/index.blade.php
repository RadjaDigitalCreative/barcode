@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
@include('product.create')
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Product</h3>
    </div>
    <div class="panel-body">
        <div style="margin-bottom: 15px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter5">+ Add Product</button>
        </div>
        <table class="table table-striped" id="tableCategory" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Time Created</th>
                    <th>Time Expired</th>
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
                window.location.href = '{!! url('product/') !!}/'+id+'/delete'
            }
        })
    }
    $(document).ready(function() {
        $('#tableCategory').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('product') }}",
            columns: [{
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
                data: 'price',
                name: 'price'
            },
            {
                data: 'time_act',
                name: 'time_act'
            },
            {
                data: 'time_exp',
                name: 'time_exp'
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
