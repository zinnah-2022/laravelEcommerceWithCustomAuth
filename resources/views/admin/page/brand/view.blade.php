@extends('admin.index')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid my-2">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Brand Name</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('brand.create')}}" class="btn btn-primary">New Brand</a>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table id="myTable" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th width="100">Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th class="col-1 text-right" >Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        @forelse($brands as $key=>$brand)
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{$brand->brand_name}}</td>
                                <td>{{$brand->brand_slug}}</td>
                                @if($brand->brand_status)
                                    <td>
                                        <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </td>
                                @else
                                    <td>
                                        <svg class="text-danger-500 h-6 w-6 text-danger" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </td>
                                @endif
                                <td class="col-1 text-right" >
                                    <a href="{{route('brand.edit', $brand->id)}}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="Brand_delete('{{$brand->id}}')" class="text-danger w-4 h-4 mr-1">
                                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path ath="" fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                    </ul>
                </div>
            </div>
        </div>
        @push('js')
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        @endpush
        <script>
            $('#myTable').DataTable();
            let Brand_delete = (id) =>{
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
                            let response= axios.delete('/dashboard/brand/'+id);
                            console.log(response);
                        }catch (e) {
                            console.log(e)
                        }
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                        )
                    }
                })

            };

        </script>
@endsection

{{--            document.addEventListener('DOMContentLoaded', async ()=>{--}}
{{--                let view=''--}}
{{--                let i=0;--}}
{{--                try {--}}
{{--                    const  response= await axios.get('/dashboard/brand_name');--}}
{{--                    response.data.forEach(function (value){--}}
{{--                        view+=`<tr>--}}
{{--                             <td>${++i}</td>--}}
{{--                            <td>${value.brand_name}</td>--}}
{{--                            <td>${value.brand_slug}</td>--}}
{{--                            <td>--}}
{{--                            <a href="">--}}
{{--                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="text-danger w-4 h-4 mr-1">--}}
{{--                            <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                <path ath="" fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                            </td>--}}
{{--                        </tr>`--}}

{{--                    })--}}
{{--                    document.getElementById('tbody').innerHTML=view;--}}
{{--                }catch (e) {--}}
{{--                    console.log(e)--}}
{{--                }--}}
{{--            });--}}
