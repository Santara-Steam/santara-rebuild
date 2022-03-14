@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List Penerbit</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="{{url('admin/emiten/add')}}" class="btn btn-primary">Tambah Penerbit</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Owner</th> --}}
                                                    <th>Nama Perusahaan</th>
                                                    <th>Nama Brand</th>
                                                    <th>Kode</th>
                                                    <th>Kategori</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($emiten as $item)
                                                <tr>
                                                    {{-- <td>{{$item->trader_id}}</td> --}}
                                                    <td>{{$item->company_name}}</td>
                                                    <td>{{$item->trademark}}</td>
                                                    <td>{{$item->code_emiten}}</td>
                                                    <td>{{$item->ktg}}</td>
                                                    <td>{{$item->sts}}</td>
                                                    <td>
                                                        <div class="row flex">
                                                            <div class="col-6">
                                                                <a href="{{url('admin/emiten/edit')}}/{{$item->id}}" class="btn btn-sm btn-warning">Edit</a>
                                                            </div>
                                                            <div class="col-6">
                                                                <form method="post" action="{{url('/emiten/delete')}}/{{$item->id}}" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                                </form>
                                                            </div>
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection