@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary mx-auto col-8 mt-3">
                <div class="card-header card-primary">
                    <h3 class="card-title">Create Brand Name</h3>
                </div>
                <form name="my">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Write Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control"
                                   placeholder="Enter Category" required>
                            <span class="text-danger" id="error"></span>
                        </div>
                        <div class="form-group">
                            <label class="text-gray">http://localhost/</label>
                            <label class="text-gray" id="slug" for="exampleInputEmail1"></label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="brand_status" class="form-check-input" value="1" id="brand_status"  required>
                            <label class="form-check-label" for="exampleCheck1">Status(Active or Inactive)</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" onclick="brand_data()" class="btn btn-sm btn-primary">Submit</a>
                        <a href="{{route('brand.index')}}"   class="btn text-right btn-sm btn-danger">Cancel</a>
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
        document.getElementById('brand_name').addEventListener('focusout', function () {
            let input = document.getElementById('brand_name').value;
            document.getElementById('slug').textContent = slugify(input);
        })

        async function brand_data() {
            let form=document.forms.my;
            try {
                const response = await axios.post('/dashboard/brand', {
                    brand_name: form.elements.brand_name.value,
                    brand_status: form.elements.brand_status.value,
                })
                console.log(response);
                document.forms.my.reset();
            } catch (e) {
                let m=e.response.data.message;
                document.getElementById('error').innerText=m;
            }
        }

    </script>
@endsection
