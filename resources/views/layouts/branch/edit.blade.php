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
                                	<h2 class="info text-center">{{$branch->code}}</h2>
                                    <h4 class="form-section"><i class="ft-user"></i> البيانات الأساسية</h4>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="name">اسم الفرع / المخزن<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" id="name" class="form-control" placeholder="ادخل اسم الفرع / المخزن.." name="name" value="{{$branch->name}}" required data-validation-required-message="هذا الحقل مطلوب">
                                        </div>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="tree">النوع<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <select class="select2 form-control" id="tree" name="tree" required data-validation-required-message="هذا الحقل مطلوب">
                                                <option></option>
                                                <option value="0" 
                                                @if($branch->type === 0)
                                                    selected
                                                @endif
                                                >مخزن رئيسى</option>
                                                <option value="1" 
                                                @if($branch->type === 1)
                                                    selected
                                                @endif
                                                >مخزن فرعى</option>
                                                <option value="2" 
                                                @if($branch->type === 2)
                                                    selected
                                                @endif
                                                >فرع بيع</option>
                                                <option value="3" 
                                                @if($branch->type === 3)
                                                    selected
                                                @endif
                                                >الشركة / المؤسسة</option>
                                            </select>    
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-clipboard"></i>بيانات أضافية</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="address">العنوان</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="address" class="form-control" placeholder="ادخل العنوان.." name="address" value="{{$branch->address}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="tel">التليفون</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="tel" id="tel" class="form-control" placeholder="ادخل التليفون.." name="tel"  value="{{$branch->tel}}" />
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
        $('.select2').select2({
            placeholder: "اختر النوع"
        });
        function printErrorMsg(msg) {
          $('.bg-danger').remove();
          $('.form-group').find('.is-invalid').addClass('valid');
          $('.form-group').find('.is-invalid').removeClass('is-invalid state-invalid');
          $.each( msg, function( key, value ) {
            $('#'+key).removeClass('is-invalid state-invalid');
            $('#'+key).addClass('is-invalid state-invalid');
            $('#'+key).parent().append('<div class="bg-danger">'+value+'</div>');
          });
        }
        $(".emad").submit(function(stay){
            stay.preventDefault();
            var name = $('#name').val();
            var tree = $('#tree').val();
            var tel = $('#tel').val();
            var address = $('#address').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('branch.update', $branch->id) }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    "name": name,
                    "tree": tree,
                    "tel": tel,
                    "address": address,
                    "_method": 'PUT',
                },
                
                beforeSend:function(){
                    
                },
                success: function (data) {
                    if($.isEmptyObject(data.error)){
                        toastr.warning('عمل رائع', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); }  });
                    }else{
                        printErrorMsg(data.error);
                    }
                },
            });
        });
    </script>
@endsection