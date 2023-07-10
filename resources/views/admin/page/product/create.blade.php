@extends('admin.index')
@section('content')
    <div class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="formElem">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                   placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="text-gray">URL: http://localhost/</label>
                                        <label class="text-gray" id="slug" for="exampleInputEmail1"></label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="summernote" cols="15" rows="6"
                                                      class="summernote" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
        </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h4 mb-3">Media</h2>
                <div id="image[]" class="dropzone dz-clickable">
                    <div class="dz-message needsclick">
                        <br>Drop files here or click to upload.<br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h4 mb-3">Pricing</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="compare_price">Compare at Price</label>
                            <input type="text" name="compare_price" id="compare_price" class="form-control"
                                   placeholder="Compare Price">
                            <p class="text-muted mt-3">
                                To show a reduced price, move the product’s original price into Compare at price. Enter
                                a lower value into Price.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h4 mb-3">Inventory</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sku">SKU (Stock Keeping Unit)</label>
                            <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty"
                                       checked>
                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Product status</h2>
                    <div class="mb-3">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option>Block</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="h4  mb-3">Product category</h2>
                    <div class="mb-3">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option selected disabled>select category</option>
                            @foreach($category as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category">Sub category</label>
                        <select name="sub_category" id="sub_category" class="form-control">
                            <option disabled selected>Select SubCategory</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Product brand</h2>
                    <div class="mb-3">
                        <select name="brand_name" id="brand_name" class="form-control">
                            <option disabled selected>Select SubCategory</option>
                            @foreach($brandName as $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="h4 mb-3">Featured product</h2>
                    <div class="mb-3">
                        <select name="status" id="status" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    @push('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    @endpush
    <script type="module">
        Dropzone.autoDiscover = false;
        $(function () {
            tinymce.init({
                selector: '#summernote',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
            const dropzone = $("#image").dropzone({
                url: "create-product.html",
                maxFiles: 5,
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }, success: function (file, response) {
                    $("#image_id").val(response.id);
                }
            });

        });
        const slugify = str =>
            str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        document.getElementById('title').addEventListener('focusout', function () {
            let input = document.getElementById('title').value;
            document.getElementById('slug').textContent = slugify(input);
        })
    </script>
    <script>
        document.getElementById('category').addEventListener('change', async () => {
            try {
                let demo = '<option selected disabled>Select SubCategory</option>'
                let id = document.getElementById('category').value;
                let response = await axios.get('/dashboard/product/sub_category/' + id);
                response.data.forEach((value) => {
                    demo += `<option value="${value.id}">${value.sub_name}</option>`
                })
                document.getElementById('sub_category').innerHTML = demo
                console.log(response)
            } catch (e) {
                console.log(e)
            }

        })


        formElem.onsubmit = async (e) => {
            e.preventDefault();
            try {
                let dataForm=new FormData(formElem);
                let response = await axios.post('/dashboard/product',dataForm);
                console.log(response);
            }catch (e) {
                console.log(e);
            }
        };

    </script>
@endsection
