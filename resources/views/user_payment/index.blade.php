@extends('layouts.master')
@section('title')Dashboard @endsection
@section('header')
@endsection
@section('content')
    @include('user_payment.create')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Pembayaran User</h3>
        </div>
        <div class="panel-body">
            <div style="margin-bottom: 15px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter9">+
                    Add User
                </button>
                <a href="{{route('subcription-price.index')}}" class="btn btn-warning">Add Price</a>
            </div>
            <table id="table_id" class="table table-striped table-bordered" cellspacing="auto" width="100%">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Lokasi</th>
                    <th>No. Telp</th>
                    <th>Total Pembayaran</th>
                    <th>Tgl Bayar</th>
                    <th>Status</th>
                    <th>Masa Pemakaian</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th colspan="5" style="padding-left: 10px">Rp.
                        {{ number_format($count_payment->countTotal, 2, ',', '.') }}</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Lokasi</th>
                    <th>No. Telp</th>
                    <th>Total Pembayaran</th>
                    <th>Tgl Bayar</th>
                    <th>Status</th>
                    <th>Masa Pemakaian</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        function deleteData() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }

        $(document).ready(function () {
            $('#table_id').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ],
                processing: true,
                serverside: true,

                ajax: "{{ route('user-payment.index') }}",
                columns: [{
                    data: 'name',
                    name: 'name'
                },
                    {
                        data: 'role_name',
                        name: 'role_name'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'total_payment',
                        name: 'total_payment',
                        render: function (data, type, row, meta) {
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
                        data: 'payment_date',
                        name: 'payment_date',
                        render: function (data) {
                            if (data == null) {
                                return '-'
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'status_payment',
                        name: 'status',
                        render: function (data) {
                            if (data == null) {
                                return 'Belum Terlunasi'
                            } else {
                                return data
                            }
                        }
                    },
                    {
                        data: 'masa_pemakaian',
                        name: 'masa_pemakaian'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ]
            });
        });
    </script>
@endsection
