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
                                    <label for="exampleInputEmail1">Write Category</label>
                                    <input type="text" name="name" id="stt" class="form-control" placeholder="Enter Category">
                                </div>
                                <div class="form-group">
                                    <label class="text-gray">http://localhost/</label>
                                    <label class="text-gray" id="st" for="exampleInputEmail1"></label>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="image" class="custom-file-input">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="status" class="form-check-input" value="1" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Status(Active or Inactive)</label>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="#" onclick="getUser()" class="btn btn-sm btn-primary">Submit</a>
                                <a href="{{route('category.index')}}"   class="btn text-right btn-sm btn-danger">Cancel</a>
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

        async function getUser() {
            try {
                const response = await axios.postForm('/dashboard/category',{
                    name:document.getElementById('stt').value,
                    status:document.getElementById('exampleCheck1').value,
                    image:document.getElementById('image').files[0]
                },{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
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
                    title: 'Signed in successfully'
                })
            } catch (error) {
                console.error(error);
            }
        }
    </script>
@endsection
