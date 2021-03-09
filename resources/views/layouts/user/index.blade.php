@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/loaders/loaders.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-loader.css')}}">
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
                            @if($users->count() === 0)
                                <div class="row justify-content-md-center">
                                    <h4 style="margin-bottom: 15px;">لايوجد أى مستخدم للنظام حاليا .. يمكنك انشاء مستخدم جديد من خلال الضغط على الزر بالاسفل !</h4>
                                </div>
                                <div class="row justify-content-md-center">         
                                    <a href="{{ route('user.create') }}" class="btn btn-round btn-warning clear"><i class="la la-plus"></i> اضافة مستخدم جديد</a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>كود المستخدم</th>
                                                <th>اسم المستخدم</th>
                                                <th>تليفون</th>
                                                <th>الفرع / المخزن</th>
                                                <th>الحالة</th>
                                                <th>عمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{$user->code}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->tel}}</td>
                                                <td>{{$user->branch->name}}</td>
                                                <td>
                                                    @if($user->isOnline())
                                                        <div class="double-bounce loader-success" style="width: 15px; height: 15px; margin: 0;">
                                                            <div class="child double-bounce1"></div>
                                                            <div class="child double-bounce2"></div>
                                                        </div>  
                                                    @else
                                                        <div class="double-bounce loader-danger" style="width: 15px; height: 15px; margin: 0;">
                                                            <div class="child double-bounce1"></div>
                                                            <div class="child double-bounce2"></div>
                                                        </div>    
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-group text-left" style="margin-bottom: auto;">
                                                        <!-- Floating icon Outline button -->
                                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                                                        <button type="button" data-id="{{$user->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>كود المستخدم</th>
                                                <th>اسم المستخدم</th>
                                                <th>تليفون</th>
                                                <th>الفرع / المخزن</th>
                                                <th>الحالة</th>
                                                <th>عمليات</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer-top')

    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>


@endsection

@section('footer-bottom')
  
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script type="text/javascript">

    $('.dataex-html5-selectors').DataTable({
        dom: 'Bfrtip',
        language: {
            search: "البحث",
            "lengthMenu": "اظهار _MENU_ نتائج للصفحة الواحدة",
            "info": "الشاشة رقم _PAGE_ من _PAGES_ شاشات",
            "paginate": {
                "first":      "الأولى",
                "last":       "الأخيره",
                "next":       "التالى",
                "previous":   "السابق"
            },
            "emptyTable":     "لايوجد بيانات حاليا",
            buttons: {
                colvis: 'اخفاء / اظهار الاعمدة',
                copy: 'نسخ',
                excel: 'اكسيل'
            }
        },
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            
            'colvis'
        ]
    });

    var selectIds;

    $('.btn-danger').on('click', function(){
        var selectIds = $(this).data('id');
        Swal.fire({
          title: 'هل انت متاكد ؟',
          text: "سيتم حذف هذا المنتج نهائيا !",
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
            
            var url = "{{ route('user.destroy', ':selectIds') }}";
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

    $('.print').on('click', function(){
        window.print();
    });
    </script>
@endsection