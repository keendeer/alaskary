@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
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
                            @if($clients->count() === 0)
                                <div class="row justify-content-md-center">
                                    <h4 style="margin-bottom: 15px;">لايوجد أى عميل حاليا .. يمكنك انشاء عميل جديد من خلال الضغط على الزر بالاسفل !</h4>
                                </div>
                                <div class="row justify-content-md-center">         
                                    <a href="{{ route('client.create') }}" class="btn btn-round btn-warning clear"><i class="la la-plus"></i> اضافة عميل جديد</a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered row-grouping dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>كود العميل</th>
                                                <th>اسم العميل</th>
                                                <th>نوع العميل</th>
                                                <th>تليفون</th>
                                                
                                                <th>عمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                            <tr>
                                                <td>{{$client->code}}</td>
                                                <td>{{$client->name}}</td>
                                                <td>
                                                    @if($client->type === 0)
                                                        جملة
                                                    @else
                                                        قطاعى
                                                    @endif
                                                </td>
                                                <td>{{$client->tel}}</td>
                                                <td>
                                                    <div class="form-group text-left" style="margin-bottom: auto;">
                                                        @can('update', $client)
                                                            <a href="{{route('client.edit', $client->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                                                        @endcan
                                                        @can('delete', $client)
                                                            <button type="button" data-id="{{$client->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>كود العميل</th>
                                                <th>اسم العميل</th>
                                                <th>نوع العميل</th>
                                                <th>تليفون</th>
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
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
        "order": [
            [2, 'asc']
        ],
        "displayLength": 25,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(2, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
        },
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

    /*$('.btn-danger').on('click', function(){
        var selectIds = $(this).data('id');
        var url = "{{ route('client.destroy', ':selectIds') }}";
        url = url.replace(':selectIds', selectIds);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            method: 'DELETE',
            success: function(data){  
              
              toastr.error('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); } });
                           
            }
        });
    });*/

    $('.btn-danger').on('click', function(){
        var selectIds = $(this).data('id');
        Swal.fire({
          title: 'هل انت متاكد ؟',
          text: "فى حالة الحذف سيقوم بحذف كل اوامر البيع التابعين لهذا العميل بطريقة اوتوماتيكية !",
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
            
            var url = "{{ route('client.destroy', ':selectIds') }}";
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