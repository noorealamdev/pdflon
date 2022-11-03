@extends('backend.layouts.master')
@section('content')
    @include('backend.partials.alert')

    <div class="content-header row">
        <div class="content-header-left col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="float-left m-t-5" style="font-weight: bold;padding: 2px;font-size: 25px;margin-right: 22px;">My PDF</div>
                    <a href="{{ route('tool.index') }}" class="btn btn-primary waves-effect waves-float waves-light">Create New</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Overview -->
                <div class="dashboard-template-wrapper">
                    @foreach($templates as $template)
                        <div class="dashboard-template-item mr-2 d-inline-block">
                            <div class="dashboard-template-image mb-1">
                                <img src="{{ $template->image }}" alt="">
                            </div>
                            <div class="dashboard-template-name">
                                @if($template->name)
                                    <h4>{{ $template->name }}</h4>
                                @else
                                    <h4>No Name</h4>
                                @endif
                            </div>
                            <div class="dashboard-template-buttons">
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('template.edit', $template->id) }}">Edit</a>
                                <a class="btn btn-danger waves-effect waves-float waves-light" href="#" data-toggle="modal"
                                   data-target="#deleteModal{{ $template->id }}">
                                    Delete
                                </a>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal{{ $template->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="teamModalCenterTitle">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center"><h5>This can not be undone</h5></div>
                                    <div class="modal-footer">
                                        <form class="d-inline-block"
                                              action="{{ route('template.destroy', $template->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-success">Yes, delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    <!--/ Overview -->
    </div>

@endsection
