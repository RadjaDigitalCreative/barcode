@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
@include('company.create')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Company</h3>
    </div>
    <div class="panel-body">
        <div style="margin-bottom: 15px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter6">+ Add Company</button>
        </div>
        <table class="table table-striped" id="tableCompany" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Company</th>
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
                window.location.href = '{!! url('company/') !!}/'+id+'/delete';
            }
        })
    }

    $(document).ready(function() {
        $('#tableCompany').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('company') }}",
            columns: [

            {
                data: 'name_perusahaan',
                name: 'name_perusahaan'
            },
            {
                data: 'action',
                name: 'action',
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
