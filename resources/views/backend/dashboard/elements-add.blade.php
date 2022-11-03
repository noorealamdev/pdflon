@extends('backend.layouts.master')
@section('content')
    @include('backend.partials.alert')

    <div class="content-header row">
        <div class="content-header-left col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="float-left m-t-5" style="font-weight: bold;padding: 2px;font-size: 25px;margin-right: 22px;">Add Icons</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Overview -->
        <form action="{{ route('elements.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name <span class="field-required">*</span></label>
                <input type="text" class="form-control" value="" name="name" required>
                <label>Category Name</label>
                <input type="text" class="form-control" value="" name="category">
                <label>SVG String <span class="field-required">*</span></label>
                <textarea class="form-control" rows="12" name="svg" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
        </form>
    </div>
    <!--/ Overview -->
    </div>

@endsection
