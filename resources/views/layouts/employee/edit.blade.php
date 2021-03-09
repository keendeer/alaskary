@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
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
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                      
                            <form class="form form-horizontal striped-rows form-bordered emad" novalidate enctype="multipart/form-data">
                                <div class="form-body">
                                    <h2 class="info code text-center">
                                        {{$employee->code}}
                                    </h2>
                                    <h4 class="form-section"><i class="ft-employee"></i> البيانات الأساسية</h4>
                                    
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="cname">اسم البائع<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" id="cname" class="form-control mb-1" placeholder="ادخل اسم البائع.." name="cname" required data-validation-required-message="هذا الحقل مطلوب" value="{{$employee->name}}" />
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="ctel">التليفون<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="tel" id="ctel" class="form-control" placeholder="ادخل التليفون.." name="ctel" required data-validation-required-message="هذا الحقل مطلوب" value="{{$employee->tel}}" />
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="tree">المستخدم الأساسى للنظام <span class="required">*</span></label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="select2 form-control" id="tree" name="tree" required>                  
                                                @foreach ($users as $user)
                                                    @if($user->branch->type === 2)
                                                        <option value="{{$user->id}}"
                                                            @if($user->id === $employee->user->id)
                                                                selected
                                                            @endif
                                                            >{{$user->name}}</option>
                                                    @endif 
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                    
                                    <h4 class="form-section"><i class="ft-clipboard"></i> البيانات الأضافية</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="cmail">الوصف</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="وصف عمل المستخدم">{{$employee->desc}}</textarea>
                                        </div>
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
        </div>
    </section>
@endsection

@section('footer-bottom')
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
	<script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
	<script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script type="text/javascript">
        $(".emad").submit(function(stay){
            stay.preventDefault();
            var cname = $('#cname').val();
            var tree = $('#tree').val();
            var ctel = $('#ctel').val();
            var desc = $('#desc').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('employee.update', $employee->id) }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    "cname": cname,
                    "tree": tree,
                    "ctel": ctel,   
                    "desc": desc,
                    "_method": 'PUT',
                },
                
                beforeSend:function(){
                    
                },
                //enctype: 'multipart/form-data',
                success: function (data) {

                   // $(".emad").reset();

                    toastr.info('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true });
                },
            });
        });
    </script>
@endsection