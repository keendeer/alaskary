@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/checkboxes-radios.css')}}">
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
                                        {{$item->code}}
                                    </h2>
                                    <input type="text" id="code" style="display: none; border: none; font-size: 1.74rem; padding: 0; line-height: normal; height: auto;" class="form-control text-center info" placeholder="ادخل كود المنتج.." name="code" required data-validation-required-message="هذا الحقل مطلوب">
                                    <fieldset class=" skin skin-line col-md-3 m-auto">
                                        <input type="checkbox" id="code-manual" class="toprole">
                                        <label for="code-manual">لتعديل كود المنتج يدويا ؟ اضغط هنا</label>
                                    </fieldset>
                                    <h4 class="form-section"><i class="ft-user"></i> البيانات الأساسية</h4>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="name">اسم المنتج <span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" id="name" class="form-control" placeholder="ادخل اسم المنتج.." name="name" required data-validation-required-message="هذا الحقل مطلوب" value="{{$item->name}}" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="tree">التصنيف <span class="required">*</span></label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="select2 form-control" id="tree" name="tree" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @foreach ($category->subCategory as $childCategory)
                                                        @include('layouts.category.child', ['item_cat_id' => $item->category_id, 'child_category' => $childCategory])
                                                    @endforeach
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                     <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="boxqt">الصندوق = X قطعه <span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="number" id="boxqt" class="form-control" placeholder="ادخل عدد القطع داخل الصندوق.." name="boxqt" required data-validation-required-message="هذا الحقل مطلوب" value="{{$item->boxqt}}" />
                                        </div>
                                    </div>

                                    <h4 class="form-section"><i class="ft-clipboard"></i> البيانات الخاصة ببيع الجملة</h4>
                                    

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="gprice">السعر للقطعه <span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="number" step="0.01" id="gprice" class="form-control" placeholder="ادخل سعر القطعه للجمله.." name="gprice" required data-validation-required-message="هذا الحقل مطلوب" value="{{$item->gprice}}" />
                                        </div>
                                    </div>
                                    
                                    <h4 class="form-section"><i class="ft-clipboard"></i> البيانات الخاصة ببيع القطاعى</h4>
                                   

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="tprice">السعر للقطعه</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" id="tprice" class="form-control" placeholder="ادخل سعر القطعه للقطاعى.." name="tprice" value="{{$item->price}}" />
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
    <script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
	<script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
	<script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
	<script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/checkbox-radio.js')}}"></script>
    <script type="text/javascript">
        $('#code-manual').on('ifChecked', function(event){  
            $('.code').hide();    
            $('#code').show(); 
        });

        $('#code-manual').on('ifUnchecked', function(event){    
            $('.code').show();    
            $('#code').hide(); 
        });
        $(".emad").submit(function(stay){
            var code;
            if($('#code').val()!=''){
                code = $('#code').val();
            }else{
                code = $('.code').text();
            }
            stay.preventDefault();
            var name = $('#name').val();
            var tree = $('#tree').val();
            var boxqt = $('#boxqt').val();
            var gprice = $('#gprice').val();
            var price = $('#price').val();

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('item.update', $item->id) }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    "code": code,
                    "name": name,
                    "tree": tree,
                    "boxqt": boxqt,
                
                    "gprice": gprice,
                    "price": price,
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