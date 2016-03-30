@extends('layouts.control')

@section('content')

    <form method="get" action="{{ URL::action('Control\CategoryController@index') }}"
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
                    <a href="{{ URL::route('admin.category.add') }}" class="btn btn-primary">Add New</a>
                </p>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Name</th>
                    <th>Thumbnail</th>
                    <th width="200">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->thumbnail)
                                    <img src="{{ asset('uploads/thumbnail').'/'.$category->thumbnail }}" width="50">
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::action('Control\CategoryController@edit', $category->id) }}"
                                   title="Edit"
                                   class="btn btn-info"><i class="fa fa-pencil-square"></i> Edit</a>
                                <a onclick="if(!confirm('Are you sure?')) return false; "
                                   href="{{ URL::action('Control\CategoryController@delete', $category->id) }}"
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

    @if($categories->count() > 0)
        <hr>
        <div class="row">
            <div class="col-md-4">
                <p>Displaying {{ $categories->firstItem() }} to {{ $categories->lastItem() }}
                    of {{ $categories->total() }} Item(s)</p>
            </div>
            <div class="col-md-8 text-right">
                {!! $categories->render() !!}
            </div>
        </div>
        <hr>
    @endif

@endsection