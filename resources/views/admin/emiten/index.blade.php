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
                                        <li><a href="{{url('admin/emiten/add')}}" class="btn btn-primary">Tambah
                                                Penerbit</a></li>
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
                                                    <th width="30%">Status</th>
                                                    <th width="18%">Action</th>
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
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-8">
                                                                {{$item->sts}}
                                                            </div>
                                                            @if ($item->sts == 'Pembagian Dividen')
                                                            <div class="col-4">
                                                                
                                                            </div>
                                                            @else
                                                            <div class="col-4">
                                                                <button type="button" class="btn btn-sm btn-success"
                                                                    data-toggle="modal"
                                                                    data-target="#default{{$item->id}}">
                                                                    Update Status
                                                                </button>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row flex">
                                                            <div class="col-6">
                                                                <a href="{{url('admin/emiten/edit')}}/{{$item->id}}"
                                                                    class="btn btn-sm btn-warning">Edit</a>
                                                            </div>
                                                            <div class="col-6">
                                                                <form method="post"
                                                                    action="{{url('/emiten/delete')}}/{{$item->id}}"
                                                                    enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger">Delete</button>
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

@foreach ($emiten as $item)
<div class="modal fade text-left" id="default{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{url('/emiten/update_status')}}/{{$item->id}}" method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="projectinput6">Status</label>
                        <select id="projectinput6" name="title" class="form-control">
                            <option value="{{$item->sts}}" selected hidden>{{$item->sts}}</option>

                            @if ($item->sts == 'Pra Penawaran Saham')
                            <option value="Penawaran Saham">Penawaran Saham</option>
                            <option value="Pendanaan Terpenuhi">Pendanaan Terpenuhi</option>
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($item->sts == 'Penawaran Saham')
                            <option value="Pendanaan Terpenuhi">Pendanaan Terpenuhi</option>
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($item->sts == 'Pendanaan Terpenuhi')
                            <option value="Penyerahan Dana">Penyerahan Dana</option>
                            <option value="Pembagian Deviden">Pembagian Deviden</option>
                            @elseif($item->sts == 'Penyerahan Dana')
                            <option value="Pembagian Dividen">Pembagian Dividen</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="datetime-local" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->sd))}}"
                            class="form-control" name="start_date" id="start_date">
                        {{-- {{$item->sd}} --}}
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tanggal Selesai</label>
                        <input type="datetime-local" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($item->ed))}}"
                            class="form-control" name="end_date" id="end_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection