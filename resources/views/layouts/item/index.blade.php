@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <style type="text/css">
        @media print
        {
            .non-printable { visibility:hidden; }
            .printable { visibility:visible; }
        }
    </style>
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
                            @if($items->count() === 0)
                                <div class="row justify-content-md-center">
                                    <h4 style="margin-bottom: 15px;">لايوجد أى منتجات حاليا .. يمكنك انشاء منتج جديد من خلال الضغط على الزر بالاسفل !</h4>
                                </div>
                                <div class="row justify-content-md-center">         
                                    <a href="{{ route('item.create') }}" class="btn btn-round btn-warning clear"><i class="la la-plus"></i> اضافة منتج جديد</a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered row-grouping dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>QR Code</th>
                                                <th>كود المنتج</th>
                                                <th>التصنيف</th>
                                                <th>اسم المنتج</th>
                                                <th>عدد القطع بالصندوق</th>
                                                <th>سعر القطعه / جملة</th>
                                                <th>سعر القطعه / قطاعى</th>
                                                <th>عمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>
                                                    <a  class="" data-toggle="modal" data-target="#it{{$item->id}}">
                                                        <?php echo DNS2D::getBarcodeSVG($item->code, 'QRCODE'); ?>
                                                    </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade text-left" id="it{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel{{$item->id}}">مشاهدة وطباعه الكود</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center printable">
                                                                    <?php echo DNS2D::getBarcodeSVG($item->code, 'QRCODE', 5,5); ?>  
                                                                    <h4 class="secondary" style="margin-top: 10px;">{{$item->code}}</h4>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="print btn btn-outline-primary">طباعه</button>
                                                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">اغلاق</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>        
                                                </td>
                                                <td>{{$item->code}}</td>
                                                <td>{{$item->category->childCategory->name}} / {{$item->category->name}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->boxqt}}</td>
                                                <td>{{$item->gprice}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>
                                                    <div class="form-group text-left" style="margin-bottom: auto;">
                                                        <!-- Floating icon Outline button -->
                                                        @can('update', $item)
                                                        <a href="{{route('item.edit', $item->id)}}" class="btn btn-icon btn-info mr-1 btn11"><i class="la la-pencil"></i></a>
                                                        @endcan
                                                        @can('delete', $item)
                                                        <button type="button" data-id="{{$item->id}}" class="btn btn-icon btn-danger mr-1 btn11"><i class="la la-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>كود المنتج</th>
                                                <th>التصنيف</th>
                                                <th>اسم المنتج</th>
                                                <th>عدد القطع بالصندوق</th>
                                                <th>سعر القطعه / جملة</th>
                                                <th>سعر القطعه / قطاعى</th>
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
                        '<tr class="group"><td colspan="7">' + group + '</td></tr>'
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

    $('.btn-danger').on('click', function(){
        var selectIds = $(this).data('id');
        Swal.fire({
          title: 'هل انت متاكد ؟',
          text: "سيتم حذف هذا المستخدم نهائيا !",
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
            
            var url = "{{ route('item.destroy', ':selectIds') }}";
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