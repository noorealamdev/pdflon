@extends('frontend.layouts.master')
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="float-left m-t-5" style="font-weight: bold;padding: 2px;font-size: 25px;margin-right: 22px;">PDF Templates</div>
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
                        <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('template.edit', $template->id) }}">Use This Template</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--/ Overview -->
    </div>

@endsection
