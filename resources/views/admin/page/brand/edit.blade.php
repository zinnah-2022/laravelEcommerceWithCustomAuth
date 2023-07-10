@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary mx-auto col-8 mt-3">
                <div class="card-header card-primary">
                    <h3 class="card-title">Create Category</h3>
                </div>
                <form action="{{route('brand.update', $brand->id)}}" method="post" id="myform">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Write Category</label>
                            <input type="text" name="brand_name" id="stt" class="form-control" value="{{$brand->brand_name}}" placeholder="Enter Category">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" {{$brand->brand_status? 'checked':""}} name="brand_status" class="form-check-input" value="1" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Status(Active or Inactive)</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" onclick="form_submit('{{$brand->id}}')"  class="btn btn-sm btn-primary">Submit</a>
                        <a href="{{route('brand.index')}}"   class="btn text-right btn-sm btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        let form_submit=async (id)=>{
            let form=document.forms.myform;
            try {
                let response=await axios.put('/dashboard/brand/'+ id,{
                    brand_name: form.elements.brand_name.value,
                    brand_status: form.elements.brand_status.value,
                });
                console.log(response)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Updated in successfully'
                })
            }catch (e) {
                console.log(e)
            }


        }
    </script>
@endsection
