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
                                        {{$user->code}}
                                    </h2>
                                    <h4 class="form-section"><i class="ft-user"></i> البيانات الأساسية</h4>
                                    
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="cname">اسم المستخدم<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" id="cname" class="form-control mb-1" placeholder="ادخل اسم المستخدم.." name="cname" required data-validation-required-message="هذا الحقل مطلوب" value="{{$user->name}}"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="ctel">التليفون</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="tel" id="ctel" class="form-control" placeholder="ادخل التليفون.." name="ctel" value="{{$user->tel}}"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="tree">الفرع / المخزن</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="select2 form-control" id="tree" name="tree" required>       
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->id}}"
                                                        @if($branch->id === $user->branch_id)
                                                            selected
                                                        @endif

                                                        >{{$branch->name}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-lock"></i> بيانات الحماية</h4>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="spassword">كلمة المرور<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="password" id="spassword" name="spassword" placeholder="كلمة المرور" class="form-control mb-1" >
                                        </div>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="spassword1">تأكيد كلمة المرور<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                           <input type="password" name="spassword1" placeholder="تأكيد كلمة المرور" data-validation-match-match="spassword" class="form-control mb-1" >
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-clipboard"></i> الصلاحيات للمستخدمين</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="cmail">الصلاحيات</label>
                                        <div class="col-md-9 mx-auto">
                                            <div class="row skin skin-line">
                                            <?php
                                                $loader = require base_path('vendor/autoload.php');
                                                $bad_module_not_required = [
                                                                            'App\Http\Controllers\Dashboard\SalesOrderItemController',
                                                                            'App\Http\Controllers\Dashboard\ExchangeController',
                                                                            'App\Http\Controllers\Dashboard\BranchItemController',
                                                                            'App\Http\Controllers\Dashboard\CreditPaymentController',
                                                                            'App\Http\Controllers\Dashboard\PermissionController',
                                                                            'App\Http\Controllers\Dashboard\HomeController',
                                                                            'BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\DashboardApiController'
                                                                            ]; 
                                                foreach($loader->getClassMap() as $class => $file){
                                                    foreach ($bad_module_not_required as $bad_module_not_required_val) {
                                                      if($bad_module_not_required_val === $class){
                                                        $class="";
                                                      }
                                                    }  
                                                    if (preg_match('/[a-z]+Controller$/', $class)){
                                                        if (preg_match('/Dashboard/', $class)){
                                                            $after =  str_replace(['App\Http\Controllers\Dashboard\\', 'Controller'], '',$class);
                                                            
                                            ?>
                                                    
                                                        <div class="col-md-3 col-sm-12 top">
                                                            <fieldset class=" skin skin-line">
                                                                <input type="checkbox" id="{{strtolower($after)}}" class="toprole" 
                                                                @foreach (json_decode($user->role) as $value) 
                                                                    @if(strtolower($after) === $value->modules)
                                                                        checked
                                                                    @endif
                                                                @endforeach
                                                                >
                                                                <label for="{{strtolower($after)}}">
                                                                   
                                                                    <?php
                                                                        switch ($after) {
                                                                            case 'Branch':
                                                                                echo 'المخازن و الأفرع';
                                                                                break;
                                                                            case 'Category':
                                                                                echo 'تصنيفات المنتجات';
                                                                                break;
                                                                            case 'Item':
                                                                                echo 'المنتجات';
                                                                                break;
                                                                            case 'Client':
                                                                                echo 'العملاء';
                                                                                break;
                                                                            case 'Employee':
                                                                                echo 'البائعين';
                                                                                break;
                                                                            case 'SalesOrder':
                                                                                echo 'اوامر البيع';
                                                                                break;                          
                                                                            default:
                                                                                echo 'مستخدمين النظام';
                                                                                break;
                                                                        }
                                                                    ?>
                                                                </label>
                                                            </fieldset>
                                                            <?php
                                                                $method_new = get_class_methods($class);
                                                                $bad_method_not_required = ['getTrashed'.$after.'s', 'update', 'updateWithAjax', 'getImage', 'latest', 'multiDestroy', 'store', 'validateWithBag', 'validate', 'validateWith', 'dispatchNow', 'authorizeResource', 'authorizeForUser', 'authorize', '__call', 'callAction', 'getMiddleware', 'middleware', '__construct', 'personStore', 'forPrf', 'forInvoice', 'itemForInvoice'];
                                                                foreach ($bad_method_not_required as $bad_method_not_required_val) {
                                                                    if(($key = array_search($bad_method_not_required_val, $method_new)) !== false){
                                                                            unset($method_new[$key]);
                                                                    }
                                                                }
                                                                foreach ($method_new as $method_name) {
                                                            ?>
                                                            <div class="row skin skin-square">
                                                                <div class="col-sm-12">
                                                                    <fieldset>
                                                                        <input type="checkbox" id="{{strtolower($after)}}{{$method_name}}" class="secondrole"
                                                                        @foreach (json_decode($user->role) as $value)
                                                                            @if(strtolower($after) === $value->modules)
                                                                            @foreach ($value->roles as $value1) 
                                                                                @if($method_name === $value1)
                                                                                    checked
                                                                                @endif
                                                                            @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                        >
                                                                        <label for="{{strtolower($after)}}{{$method_name}}">
                                                                       
                                                                        <?php
                                                                        switch ($method_name) {
                                                                            case 'index':
                                                                                echo 'مشاهدة كل العناصر';
                                                                                break;
                                                                            case 'create':
                                                                                echo 'اضافة';
                                                                                break;
                                                                            case 'show':
                                                                                echo 'مشاهدة عنصر واحد';
                                                                                break;
                                                                            case 'edit':
                                                                                echo 'تعديل';
                                                                                break;
                                                                                                     
                                                                            default:
                                                                                echo 'حذف';
                                                                                break;
                                                                        }
                                                                    ?>
                                                                        </label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    
                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-clipboard"></i> البيانات الأضافية</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="cmail">الوصف</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="وصف عمل المستخدم">{{$user->desc}}</textarea>
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
        var modules;
        var roles;
        var permissions = [];

   
        //console.log($('.toprole').iCheck('update')[0].checked);  

        

        $('.toprole').each(function (i, value) {
            if($(this).prop("checked")){
                modules=$(this).attr('id');
                permissions.push({
                    modules : modules,
                    roles : [],
                });
                
            }
        });

        $('.secondrole').each(function (i, value) {
            if($(this).prop("checked")){
                var parent_id = $(this).closest('.top').find('.toprole').attr('id');
                roles = $(this).attr('id').replace(parent_id, "");  
                $.each(permissions, function (i, value) {
                    if(value.modules === parent_id){
                      value.roles.push(roles);
                    }
                });   
            }
        });

        $('.toprole').on('ifChecked', function(event){  
            modules=$(this).attr('id');
            permissions.push({
                modules : modules,
                roles : [],
            });
            var parent_id = $(this).closest('.top');
            parent_id.find('.skin-square').show();


        });

        $('.toprole').on('ifUnchecked', function(event){    
            var v = $(this).attr('id');
            index = permissions.findIndex(x => x.modules === v);
            permissions.splice(index, 1);
            var parent_id = $(this).closest('.top');
            parent_id.find('.skin-square').hide();
        });

        $('.secondrole').on('ifChecked', function(event){
            var parent_id = $(this).closest('.top').find('.toprole').attr('id');
            roles = $(this).attr('id').replace(parent_id, "");  
            $.each(permissions, function (i, value) {
                if(value.modules === parent_id){
                  value.roles.push(roles);
                }
            });   
                                     
        });


        $('.secondrole').on('ifUnchecked', function(event){
            var parent_id = $(this).closest('.top').find('.toprole').attr('id');
            var v = $(this).attr('id').replace(parent_id, "");
            $.each(permissions, function (i, value) {
                if(value.modules === parent_id){
                    $.each(value.roles, function (ii, value1) {
                        if(value1===v){
                            value.roles.splice(ii, 1);
                        }
                    });
                }
            }); 
        });
        $(".emad").submit(function(stay){
            stay.preventDefault();
            var cname = $('#cname').val();
            var tree = $('#tree').val();
            var ctel = $('#ctel').val();
            var spassword = $('#spassword').val();
            var desc = $('#desc').val();
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('user.update', $user->id) }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    "cname": cname,
                    "tree": tree,
                    "ctel": ctel,
                    "spassword": spassword,
                    "desc": desc,
                    "permissions": permissions,
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