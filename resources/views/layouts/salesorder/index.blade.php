@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/timeline.css')}}">
    <style>
        table.dataTable tbody th, table.dataTable tbody td{ padding: 8px 10px !important;  }
        table.dataTable thead th, table.dataTable tfoot th{ padding: 10px 18px !important; color: inherit !important; }
        table.dataTable tr{ background: inherit !important;  }
        table.dataTable thead th, table.dataTable thead td{ border-bottom: 1px solid #111 !important;  }
        table.dataTable tfoot th, table.dataTable tfoot td{ border-top: 1px solid #111 !important;  }
    </style>
@endsection

@section('content')
    <section id="timeline" class="timeline-center timeline-wrapper">
        <h3 class="page-title text-center"><i class="la la-calendar-o"></i> حركات البيع ليوم {{Carbon\Carbon::today()->toDateString()}}</h3>
        @if($branches->count() !== 0)
           
                <ul class="timeline">
                    <li class="timeline-line"></li>
                    <li class="timeline-group">
                        <a href="" class="btn btn-primary position-relative">
                            {{$branches->name}}
                        </a>
                    </li>
                </ul>
                <ul class="timeline">
                    <li class="timeline-line"></li>
                    @foreach($branches->user as $key1 => $user)

                        @if($user->employee->count() !== 0 && $user->id === Auth::id())
                        @foreach($user->employee as $key2 => $employee)
                        <li class="timeline-item @if($key2%2 == 1) mt-3 @endif">
                            <div class="timeline-badge">
                                <span class="bg-red bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-money"></i>
                                </span>
                            </div>
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title"><a href="#">{{$employee->name}}</a></h4>
                                    <p class="card-subtitle text-muted mb-0 pt-1 btn-group-sm">
                                        
                                    
                                        <?php

                                        $r = App\Models\employee_timeline::where('employee_id', $employee->id)->where('updated_at', Carbon\Carbon::today()->toDateString())->get();

                                        if($r->count() !== 0){

                                        echo '<span class="font-small-3">مجموع الايرادات : <span class="daytotal">0</span> جنيه مصرى</span>    
                                        <button type="button" class="btn btn-danger">اغلاق اليوم</button>';    
                                        }
                                        ?>
                                                        
                                        
                                        
                              

                                    </p>
                                    
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        
                                        
                                        @if(count($employee->sales_order_today) !== 0)
                                        <div class="table-responsive">
                                            <table class="table dataex-html5-selectors">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>العميل</th>
                                                        <th>الضريبة</th>
                                                        <th>الخصم</th>
                                                        <th>الاجمالى</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($employee->sales_order_today as $salesorder)
                                                    
                                                    

                                                        <tr>
                                                            <td style="direction: ltr;">
                                                                <a href="{{route('salesorder.show', $salesorder->id)}}">
                                                                    {{$salesorder->code}}
                                                                </a>
                                                            </td>
                                                            <td>{{$salesorder->client->name}}</td>
                                                            <td>{{$salesorder->tax}}</td>
                                                            <td class="danger">{{$salesorder->discount}} -</td>
                                                            <td>{{$salesorder->total}}</td>
                                                        </tr>

                                                        

                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>العميل</th>
                                                        <th>الضريبة</th>
                                                        <th>الخصم</th>
                                                        <th>الاجمالى</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        @else
                                            
                                            <?php
                                            
                                            
                                            if($r->count() !== 0){
                                                ?>


                                    <table class="table dataex-html5-selectors">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>العميل</th>
                                                        <th>الضريبة</th>
                                                        <th>الخصم</th>
                                                        <th>الاجمالى</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>العميل</th>
                                                        <th>الضريبة</th>
                                                        <th>الخصم</th>
                                                        <th>الاجمالى</th>
                                                    </tr>
                                                </tfoot>
                                            </table>


                                                <?php
                                            }else{
echo '<button type="button" class="btn mb-1 btn-warning btn-lg btn-block openday" data-id="'.$employee->id.'">فتح يومية جديدة</button>';
                                            }
                                            ?>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    @endif
                    @endforeach
                </ul>
        
        @endif
    </section>
@endsection

@section('footer-top')
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
@endsection

@section('footer-bottom')
    <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-styling.js')}}"></script>
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
    });

    $('.openday').on('click', function(){
        var employee_id = $(this).data('id');
        //alert(employee_id);
        var url = "{{ route('salesordertimeline.store') }}";
        //url = url.replace(':openIds', openIds);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            method: 'POST',
            dataType: "JSON",
            data: {
                    "employee_id": employee_id,
                 
                },
            success: function(data){  
              
              toastr.info('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); } });
                           
            }
        });
    });
    </script>
    <script src="{{asset('app-assets/js/scripts/pages/timeline.js')}}"></script>
@endsection