@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary mx-auto col-8 mt-3">
                <div class="card-header card-primary">
                    <h3 class="card-title">Create Category</h3>
                </div>
                <form action="{{route('category.update', $data->id)}}" method="post" id="myform">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Write Category</label>
                            <input type="text" name="name" id="stt" class="form-control" value="{{$data->name}}" placeholder="Enter Category">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" {{$data->status? 'checked':""}} name="status" class="form-check-input" value="1" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Status(Active or Inactive)</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit"  class="btn btn-sm btn-primary">Submit</button>
                        <a href="{{route('category.index')}}"   class="btn text-right btn-sm btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
