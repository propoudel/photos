@extends('layouts.control')

@section('content')

    <form method="get" action="{{ URL::action('Control\BannerController@index') }}"
          enctype="multipart/form-data">

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <input type="text" placeholder="Search..." id="search" name="search" class="form-control1 input-sm">
                </div>
            </div>
            <div class="col-lg-2">
                <input type="submit" class="btn btn-primary" value="Search">
            </div>
            <div class="col-lg-6">
                <p class="text-right">
                    <a href="{{ URL::route('admin.banner.add') }}" class="btn btn-primary">Add New</a>
                </p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Title</th>
                    <th>Banner</th>
                    <th width="200">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @if($banners->count() > 0)
                    @foreach($banners as $banner)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $banner->title }}</td>
                            <td>
                                @if($banner->image)
                                    <img src="{{ asset('uploads/banner').'/'.$banner->image }}" width="50">
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::action('Control\BannerController@edit', $banner->id) }}"
                                   title="Edit"
                                   class="btn btn-info"><i class="fa fa-pencil-square"></i> Edit</a>
                                <a onclick="if(!confirm('Are you sure?')) return false; "
                                   href="{{ URL::action('Control\BannerController@delete', $banner->id) }}"
                                   title="Delete" class="btn btn-warning"><i class="fa fa-times-circle"></i>
                                    Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                @endif


                </tbody>
            </table>
        </div>

    </form>

    @if($banners->count() > 0)
        <hr>
        <div class="row">
            <div class="col-md-4">
                <p>Displaying {{ $banners->firstItem() }} to {{ $banners->lastItem() }}
                    of {{ $banners->total() }} Item(s)</p>
            </div>
            <div class="col-md-8 text-right">
                {!! $banners->render() !!}
            </div>
        </div>
        <hr>
    @endif

@endsection