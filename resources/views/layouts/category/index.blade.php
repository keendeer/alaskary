@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
@endsection

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show treeview">
                        <div class="card-body">
                            @if($categories->count() === 0)
                                <div class="row justify-content-md-center">
                                    <h4 style="margin-bottom: 15px;">لايوجد أى تصنيفات حاليا .. يمكنك انشاء تصنيف جديد من خلال الضغط على الزر بالاسفل !</h4>
                                </div>
                                <div class="row justify-content-md-center">         
                                    <a href="{{ route('category.create') }}" class="btn btn-round btn-warning clear"><i class="la la-plus"></i> اضافة تصنيف جديد</a>
                                </div>
                            @else
                                @foreach ($categories as $category)
                                    <ul class="list-group">
                                        <li class="list-group-item node-default-treeview">
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-md-8"><h3>{{$category->name}}</h3></div>
                                                <div class="col-12 col-sm-6 col-md-4">                                       
                                                    <div class="form-group text-right" style="margin-bottom: auto;">
                                                        <!-- Floating icon Outline button -->
                                                        @can('update', $category)
                                                        <a href="{{route('category.edit', $category->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                                                        @endcan
                                                        @can('delete', $category)
                                                        <button type="button" data-id="{{$category->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @foreach ($category->subCategory as $childCategory)
                                            @include('layouts.category.child01', ['child_category' => $childCategory])
                                        @endforeach
                                    </ul>
                                @endforeach

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer-top')
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
@endsection

@section('footer-bottom')
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script type="text/javascript">
    var selectIds;

    $('.btn-danger').on('click', function(){
        var selectIds = $(this).data('id');
        Swal.fire({
          title: 'هل انت متاكد ؟',
          text: "فى حالة الحذف سيقوم بحذف المنتجات التابعه لهذا التصنيفات والتصنيفات الفرعية ان وجد بطريقة اوتوماتيكية !",
          type: 'error',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'نعم, اريد الحذف !',
          confirmButtonClass: 'btn btn-warning',
          cancelButtonClass: 'btn btn-danger ml-1',
          cancelButtonText: 'الغاء',
          buttonsStyling: false,
        }).then(function (result) {
          if (result.value) {
            
            var url = "{{ route('category.destroy', ':selectIds') }}";
            url = url.replace(':selectIds', selectIds);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                method: 'DELETE',
                success: function(data){  
                  
                  toastr.error('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); } });
                               
                }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Your imaginary file is safe :)',
              type: 'error',
              confirmButtonClass: 'btn btn-success',
            })
          }
        })
        
    });
    </script>
@endsection