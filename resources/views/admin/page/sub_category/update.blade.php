@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary mx-auto col-8 mt-3">
                <div class="card-header card-primary">
                    <h3 class="card-title">Create Category</h3>
                </div>
                <form id="myform">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select id="category_id" class="form-control">
                                <option selected disabled>Select Category</option>
                                @foreach($subcategory as $data)
                                    <option value="{{$data->id}}" {{$Esubcategory->category_id==$data->id?'selected':''}}>{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Write Sub Category</label>
                            <input type="text" name="name" id="stt" value="{{$Esubcategory->sub_name}}" class="form-control" placeholder="Enter Category">
                        </div>
                        <div class="form-group">
                            <label class="text-gray">http://localhost/</label>
                            <label class="text-gray" id="st" for="exampleInputEmail1"></label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" {{$Esubcategory->sub_status==1?'checked':''}} name="status" class="form-check-input" value="1" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Status(Active or Inactive)</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" onclick="UP_subCategory('{{$Esubcategory->id}}')" class="btn btn-primary">Submit</a>
                        <a href="{{route('sub_category.index')}}"   class="btn text-right btn-sm btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        const slugify = str =>
            str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        document.getElementById('stt').addEventListener('focusout', function (){
            let input=document.getElementById('stt').value;
            document.getElementById('st').textContent=slugify(input);
        })

        async function UP_subCategory(id) {
            try {
                const response = await axios.put('/dashboard/sub_category/'+id,{
                    sub_name:document.getElementById('stt').value,
                    sub_status:document.getElementById('exampleCheck1').value,
                    category_id:document.getElementById('category_id').value,
                });
                console.log(response);
                document.getElementById("myform").reset();
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
            } catch (error) {
                console.error(error);
            }
        }
    </script>
@endsection
