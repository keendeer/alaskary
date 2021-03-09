@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
@endsection

@section('content')
    <section id="configuration">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card border-info">
                    <div class="card-header card-head-inverse bg-info">
                        <h4 class="card-title text-white">اضافة منتجات الى المخزن</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form class="form form-horizontal striped-rows form-bordered emad" novalidate>

                            <h4 class="form-section"><i class="ft-search"></i> تصفية المنتجات</h4>
                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control lopa" for="tree">التصنيف</label>
                                <div class="col-md-9 controls">
                                    <select class="select2 form-control" id="tree" name="tree" required data-validation-required-message="هذا الحقل مطلوب">
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @foreach ($category->subCategory as $childCategory)
                                                @include('layouts.category.child', ['child_category' => $childCategory])
                                            @endforeach
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                            
                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control lopa" for="product">المنتج</label>
                                <div class="col-md-9 controls">
                                    <select class="select2 form-control" id="product" name="product" required data-validation-required-message="هذا الحقل مطلوب">
                                        <option></option>
                                    </select>   
                                </div>
                            </div>

                            <h4 class="form-section"><i class="ft-package"></i> العمليات</h4>

                            <div class="form-group row">
                                <label class="col-md-3 label-control lopa" for="type">نوع العملية</label>
                                <div class="col-md-9 mx-auto">
                                    <select class="select2 form-control" id="type" name="type">
                                        @switch($branch->type)
                                            @case(0)
                                                <option value="0">اضافة الى المخزن</option>
                                                @break
                                            @case(1)
                                                <option value="1">ترحيل من المخزن الرئيسي الى الفرعى</option>
                                                @break    
                                            @default
                                                <option value="2">ترحيل من المخزن الى الفرع</option>
                                        @endswitch
                                        <option value="3">تعديل / حذف الكمية</option>
                                    </select>  
                                </div>
                            </div>
                            @if($branch->type === 1)
                            <div class="form-group row">
                                <label class="col-md-3 label-control lopa" for="stock">المخزن</label>
                                <div class="col-md-9 mx-auto">
                                    <select class="select2 form-control" id="stock" name="stock">
                                        @foreach($branches as $branch1)
                                            <option value="{{$branch1->id}}">{{$branch1->name}}</option>
                                        @endforeach          
                                    </select>   
                                    <p id="quantity" class="alert bg-info alert-icon-right alert-arrow-right alert-dismissible mb-2" style="margin-top: 5px; display: none;" role="alert"><span class="alert-icon"><i class="la la-info-circle"></i></span>الكمية المتواجدة حاليا : <span id="qtyinn" style="font-weight: 700 !important;"></span> قطعه</p>
                                </div>
                            </div>
                            @endif
                            @if($branch->type === 2)
                            <div class="form-group row">
                                <label class="col-md-3 label-control lopa" for="stock">المخزن الفرعى</label>
                                <div class="col-md-9 mx-auto">
                                    <select class="select2 form-control" id="stock" name="stock">
                                        @foreach($subbranches as $subbranch1)
                                            <option value="{{$subbranch1->id}}">{{$subbranch1->name}}</option>
                                        @endforeach          
                                    </select> 
                                    <p id="quantity" class="alert bg-info alert-icon-right alert-arrow-right alert-dismissible mb-2" style="margin-top: 5px; display: none;" role="alert"><span class="alert-icon"><i class="la la-info-circle"></i></span>الكمية المتواجدة حاليا : <span id="qtyinn" style="font-weight: 700 !important;"></span> قطعه</p>  
                                </div>
                            </div>
                            
                            @endif

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control lopa" for="qty">الكميه</label>
                                <div class="col-md-9 controls">
                                    <input type="number" id="qty" class="form-control" placeholder="ادخل الكمية.." name="qty" required data-validation-required-message="هذا الحقل مطلوب">
                                    <p id="qtyerror" class="alert bg-danger alert-icon-right alert-arrow-right alert-dismissible mb-2" style="margin-top: 5px; display: none;" role="alert"><span class="alert-icon"><i class="la la-close"></i></span><span id="qtyinnerror"></span></p>
                                </div> 
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary mr-1">
                                    <i class="la la-check-square-o"></i> تسجيل
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <i class="ft-x"></i> الغاء
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
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
                            <!-- -->

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered row-grouping dataex-html5-selectors datatable-select-inputs dataex-visibility-selector">
                                    <thead>
                                        <tr>
                                            <th>كود المنتج</th>
                                            <th>اسم المنتج</th>
                                            <th>التصنيف</th>
                                            <th>الكميه</th>
                                            
                                            <th>الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($branch_item as $branchitem)
                                            <tr>
                                                <td>{{$branchitem->item->code}}</td>
                                                <td>{{$branchitem->item->name}}</td>
                                                <td>{{$branchitem->item->category->name}}</td>
                                                <td>{{$branchitem->quantity}}</td>
                                                
                                                <td>
                                                    @if($branchitem->quantity > $branchitem->item->boxqt)
                                                        <div class="badge badge-success">
                                                            <i class="la la-eye font-medium-2"></i>
                                                            <span>متوفر</span>
                                                        </div>
                                                    @elseif($branchitem->quantity === 0)    
                                                        <div class="badge badge-danger">
                                                            <i class="la la-eye font-medium-2"></i>
                                                            <span>غير متوفر</span>
                                                        </div>
                                                    @else
                                                        <div class="badge badge-warning">
                                                            <i class="la la-eye font-medium-2"></i>
                                                            <span>قارب على الانتهاء</span>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>كود المنتج</th>
                                            <th>اسم المنتج</th>
                                            <th>التصنيف</th>
                                            <th>الكميه</th>
                                            
                                            <th>الحالة</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- -->
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
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script type="text/javascript">
    $('.select2').select2({
        placeholder: "اختر التصنيف"
    });
    $('#product').select2({
        placeholder: "اختر المنتج",        
    });
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
                        '<tr class="group"><td colspan="4">' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
        },
        dom: 'Bfrtip',
        language: {
            search: "البحث",
            "infoEmpty":      " ",
            "emptyTable": "لا يوجد بيانات حاليا",
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
                excel: 'اكسيل',
                print: 'طباعه'
            }
        },
        /*initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select><option value="">Select option</option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' );
            } );
        } );
        },*/
        buttons: [
            {
            extend: 'print',
            exportOptions: {
                columns: ':visible'
            }
            },
            /*{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },*/

            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            
            
            'colvis'
        ]
    });

    $('#product, #type, #qty').prop( "disabled", true );
    if($('#stock').length){
        $('#stock').prop( "disabled", true );
    }  
    function getItemQty(val1, stock1){
        if({{$branch->type}} === 1 || {{$branch->type}} === 2){
            var url1 = "{{ route('item.getQuantity') }}";
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url1,
                method: "GET",
                data: {
                    "product": val1,
                    "branch": stock1,
                    "_method": "GET",
                },
                dataType: "JSON",
                beforeSend:function(){
                    
                },
                success: function (data) {
                    $('#product, #type, #qty').prop( "disabled", false );
                    if($('#stock').length){
                        $('#stock').prop( "disabled", false );
                    }
                    $("#quantity span#qtyinn").text(data);
                    $("#quantity").show();
                    console.clear();
                },
                error: function (data) {
                    
                },
                statusCode: {
                   404: function() {
                        $('#product, #type, #qty').prop( "disabled", true );
                        if($('#stock').length){
                            $('#stock').prop( "disabled", true );
                        }
                        $('#product').select2({
                            placeholder: "لايوجد منتجات فى التصنيف",
                        });
                        $("#quantity").hide();
                        console.clear();      
                   },
                   500: function() {
                        $('#product, #type, #qty').prop( "disabled", true );
                        if($('#stock').length){
                            $('#stock').prop( "disabled", true );
                        }
                        $("#quantity").hide();
                        console.clear();      
                   }
                }
            });
        }  
    }

    $('#tree').on('change', function(){
        var val = $(this).val();
        var url = "{{ route('category.show', ':selectIds') }}";
        url = url.replace(':selectIds', val);
        $("#product").html("");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            method: "GET",
            dataType: "JSON",
            beforeSend:function(){
                
            },
            success: function (data) {
                $('#product, #type, #qty').prop( "disabled", false );
                $(data.success).each(function(key, value) {
                    $("#product").append("<option value='"+value.id+"'>"+value.name+' ('+value.code+')'+"</option>");
                });
                getItemQty($("#product option:first").val(), $("#stock option:first").val());
            },
        });
    });

    $('#product').on('change', function(){
        var val1 = $(this).val();
        getItemQty(val1, $("#stock").val());
    });

    $('#stock').on('change', function(){
        var stock = $(this).val();
        getItemQty($("#product").val(), stock);
    });

    $('#qty').on('change keyup', function(){

        if(Number($(this).val())===Number($("#quantity span#qtyinn").text())){
            $("#qtyerror").show();
            $("#qtyerror span#qtyinnerror").text('سيكون المخزون فارغًا');
        }else if(Number($(this).val())>Number($("#quantity span#qtyinn").text())){
            if($("#quantity span#qtyinn").text().length === 0){
                $("#qtyerror").hide();
            }else{
                $("#qtyerror").show();
                $("#qtyerror span#qtyinnerror").text('المدخلات أكبر من المخزون');    
            }
            
        }else{
            $("#qtyerror").hide();
        }
    });

    var selectIds;

    $(".emad").submit(function(stay){
        stay.preventDefault();
        var product = $('#product').val();
        var stock = $('#stock').val();
        var qty = $('#qty').val();
        var branch = '{{$branch->id}}';
        var type = $('#type').val();
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('itemtobranch.store') }}",
            method: "POST",
            dataType: "JSON",
            data: {
                "product": product,
                "branch": branch,
                "qty": qty,
                "type": type,
                "stock": stock,
            },
            
            beforeSend:function(){
                
            },
            success: function (data) {
                toastr.info('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); } });
            },
        });
    });
    </script>
@endsection