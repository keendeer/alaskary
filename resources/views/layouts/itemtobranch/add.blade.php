@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
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
                                    <h4>لايوجد أى عميل حاليا .. يمكنك انشاء عميل جديد من خلال الضغط على الزر بالاسفل !</h4>
                                </div>
                                <div class="row justify-content-md-center">         
                                    <a href="{{ route('item.create') }}" class="btn btn-outline-primary clear"><i class="fe fe-plus mr-1 mt-1"></i>انشاء عميل جديد</a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered row-grouping dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>كود المنتج</th>
                                                <th>اسم المنتج</th>
                                                <th>التصنيف</th>
                                                <th>العدد</th>
                                                
                                                <th>عمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>{{$item->code}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->category->childCategory->name}} / {{$item->category->name}}</td>
                                                <td>
                                                    @foreach($branch_item as $value)
                                                        @if($item->id === $value->item_id)
                                                            {{$value->quantity}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="form-group row">

                                                    <div class="col-md-4 ">

                                                        <input type="number" class="qty form-control" placeholder="العدد" name="qty" required="" data-validation-required-message="This field is required" aria-invalid="false">


                                                    </div>

                                                    <div class="col-md-4 mx-auto">
                                                        <select class="select2 form-control tree" name="tree" required>
                                                            <option value="0">قطعه</option>
                                                            <option value="1">صندوق</option>
                                                        </select>   
                                                        <p class="bg-secondary text-highlight white text-center" style="font-size: 13px; margin-top: 5px; display: none;">الصندوق من هذا المنتج يحتوى على <span>{{$item->boxqt}}</span> قطعه</p>
                                                    </div>

                                                    <div class="col-md-4 ">
                                                        <button data-branch="{{$branch->id}}" data-item="{{$item->id}}" class="btn btn-square btn-warning mb-1" type="button"><i class="la la-plus"></i> اضافة</button>

                                                    </div>

                                                </div>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>كود المنتج</th>
                                                <th>اسم المنتج</th>
                                                <th>التصنيف</th>
                                                <th>العدد</th>
                                                
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

@endsection

@section('footer-bottom')
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
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
                        '<tr class="group"><td colspan="6">' + group + '</td></tr>'
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

    $('.btn').on('click', function(){
        var item = $(this).data('item');
        var branch = $(this).data('branch');
        var qty = $(this).closest(".row").find(".qty").val();
    

         $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('itemtobranch.store') }}",
            method: "POST",
            dataType: "JSON",
            data: {
                "item": item,
                "branch": branch,
                "qty": qty,
            },
            
            beforeSend:function(){
                
            },
            //enctype: 'multipart/form-data',
            success: function (data) {

               // $(".emad").reset();

                toastr.info('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); } });
            },
        });
    });
    </script>
@endsection