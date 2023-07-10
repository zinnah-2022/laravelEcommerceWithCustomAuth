@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('category.create')}}" class="btn btn-primary">New Category</a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                   placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table id="myTable" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>image</th>
                            <th width="100">Status</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                    </ul>
                </div>
            </div>
        </div>
        <script>

            document.addEventListener('DOMContentLoaded', () => userView());

            async function userView() {
                try {
                    let i = 0;
                    let userData = ''
                    const response = await axios.get('/myuser');
                    response.data.forEach(function (value) {
                        userData += ` <tr>`
                        userData += `<td>${++i}</td>`
                        userData += `<td>${value.name}</td>`
                        userData += `<td>${value.slug}</td>`
                        userData += `<td><img src="{{asset('images/category/${value.image}')}}" width="50px"</td>`
                        if (value.status == 1) {
                            userData += `<td>
                         <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                         </td>`
                        } else {
                            userData += `<td><svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>

                           </td>`
                        }
                        userData+=`<td>
                           <a href="" onclick="editData('${value.id}')">
                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </a>
                        <a href="#" onclick="deleteData('${value.id}')" class="text-danger w-4 h-4 mr-1">
                            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path ath="" fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        </td>`
                        userData += `</tr>`
                        document.getElementById('tbody').innerHTML = userData;
                    })
                } catch (e) {
                    console.log(e)
                }
            }


             function deleteData(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = axios.delete('/dashboard/category/' + id);
                            console.log(response);
                            userView()
                            {{--window.location = '{{route('category.index')}}';--}}
                        } catch (error) {
                            console.error(error);
                        }
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            }
            async function editData(id){

                try {
                    const response=await axios.get('/dashboard/category/' + id+ '/edit');
                    console.log(response)
                    window.location = '/dashboard/category/' + id+ '/edit';
                }catch (e) {
                    console.log(e)
                }

            }

        </script>
@endsection

