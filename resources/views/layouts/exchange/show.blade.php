@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered row-grouping dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>اسم العملية</th>
                                                <th>كود المنتج</th>
                                                <th>التصنيف</th>
                                                <th>الكمية</th>
                                                <th>تاريخ العملية</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($exchanges as $exchange)
                                                <tr>
                                                    <td>
                                                        @switch($exchange->process)
                                                            @case (0)
                                                                اضافة الى المخزن
                                                                @break
                                                            @case (1)
                                                            @case (2)
                                                                اضافة من {{$exchange->getStock->name}}
                                                                @break 
                                                            @case (3)
                                                                حركة بيع
                                                                @break     
                                                            @default
                                                                تم تحويلها الى {{$exchange->getStock->name}}
                                                                @break       
                                                        @endswitch
                                                    </td>
                                                    <td>{{$exchange->item->code}} - ({{$exchange->item->name}}  1)</td>
                                                    <td>{{$exchange->item->category->name}}</td>
                                                    <td style="direction: ltr;"
                                                        @switch($exchange->process)
                                                            @case (5)
                                                            @case (3)
                                                                 class="danger"
                                                                @break 
                                                            @default
                                                                class="success"
                                                                @break       
                                                        @endswitch
                                                    >{{$exchange->quantity}}</td>
                                                    <td style="direction: ltr;">{{$exchange->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>اسم العملية</th>
                                                <th>كود المنتج</th>
                                                <th>التصنيف</th>
                                                <th>الكمية</th>
                                                <th>تاريخ العملية</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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

    <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-styling.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    
    <script type="text/javascript">
       $('.dataex-html5-selectors').DataTable({
        "columnDefs": [{
            "visible": false,
            "targets": [2,1]
        }],
        "order": [
            [2, 'asc'], [1, 'asc']
        ],
        "rowGroup": {
            dataSrc: [ 2, 1 ]
        },
        "displayLength": 25,
        
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
          text: "فى حالة الحذف سيقوم بحذف المستخدمين التابعين لهذا الفرع / المخزن بطريقة اوتوماتيكية !",
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
            
            var url = "{{ route('branch.destroy', ':selectIds') }}";
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