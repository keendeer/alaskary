@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/checkboxes-radios.css')}}">
    <style type="text/css">
        .help-block{ width: 100%; display: block; }
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
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                      
                        	<form class="form form-horizontal striped-rows form-bordered emad" novalidate enctype="multipart/form-data">
                                <div class="form-body">
                                	<h2 class="info code text-center">
                                        
                                	</h2>
                                    <h4 class="form-section"><i class="ft-user"></i> ???????????????? ????????????????</h4>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="cname">?????? ????????????????<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="text" id="cname" class="form-control mb-1" placeholder="???????? ?????? ????????????????.." name="cname" required data-validation-required-message="?????? ?????????? ??????????">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="ctel">????????????????</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="tel" id="ctel" class="form-control" placeholder="???????? ????????????????.." name="ctel" />
                                        </div>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control lopa" for="tree">?????????? / ????????????<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <select class="select2 form-control" id="tree" name="tree" required data-validation-required-message="?????? ?????????? ??????????">  
                                                <option></option>    
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-lock"></i> ???????????? ??????????????</h4>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="spassword">???????? ????????????<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                            <input type="password" id="spassword" name="spassword" placeholder="???????? ????????????" class="form-control mb-1" required data-validation-required-message="?????? ?????????? ??????????">
                                        </div>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="spassword1">?????????? ???????? ????????????<span class="required">*</span></label>
                                        <div class="col-md-9 controls">
                                           <input type="password" name="spassword1" placeholder="?????????? ???????? ????????????" data-validation-match-match="spassword" class="form-control mb-1" required data-validation-required-message="?????? ?????????? ??????????">
                                        </div>
                                    </div>
                                    
                                    <h4 class="form-section"><i class="ft-clipboard"></i> ?????????????????? ????????????????????</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="cmail">??????????????????<span class="required">*</span></label>
                                        <div class="col-md-9 mx-auto">
                                            <div class="row skin skin-line controls">
                                            <?php
                                                $loader = require base_path('vendor/autoload.php');
                                                $bad_module_not_required = [
                                                                            'App\Http\Controllers\Dashboard\SalesOrderItemController',
                                                                            'App\Http\Controllers\Dashboard\ExchangeController',
                                                                            'App\Http\Controllers\Dashboard\BranchItemController',
                                                                            'App\Http\Controllers\Dashboard\CreditPaymentController',
                                                                            'App\Http\Controllers\Dashboard\PermissionController',
                                                                            'App\Http\Controllers\Dashboard\HomeController',
                                                                            'App\Http\Controllers\Dashboard\EmployeeTimelineController',
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
                                                    
                                                        <div class="col-md-3 col-sm-12 top ">
                                                            <fieldset class=" skin skin-line ">
                                                                <input type="checkbox" id="{{strtolower($after)}}" class="toprole" data-validation-minchecked-minchecked="1" data-validation-minchecked-message="???????? ???????????? ?????????? ?????? ??????????" name="toprole" >
                                                                <label for="{{strtolower($after)}}">
                                                                   
                                                                    <?php
                                                                        switch ($after) {
                                                                            case 'Branch':
                                                                                echo '?????????????? ?? ????????????';
                                                                                break;
                                                                            case 'Category':
                                                                                echo '?????????????? ????????????????';
                                                                                break;
                                                                            case 'Item':
                                                                                echo '????????????????';
                                                                                break;
                                                                            case 'Client':
                                                                                echo '??????????????';
                                                                                break;
                                                                            case 'Employee':
                                                                                echo '????????????????';
                                                                                break;
                                                                            case 'SalesOrder':
                                                                                echo '?????????? ??????????';
                                                                                break;                          
                                                                            default:
                                                                                echo '???????????????? ????????????';
                                                                                break;
                                                                        }
                                                                    ?>
                                                                </label>
                                                            </fieldset>
                                                            <?php
                                                                $method_new = get_class_methods($class);
                                                                $bad_method_not_required = ['getTrashed'.$after.'s', 'update', 'updateWithAjax', 'getImage', 'latest', 'multiDestroy', 'store', 'validateWithBag', 'validate', 'validateWith', 'dispatchNow', 'authorizeResource', 'authorizeForUser', 'authorize', '__call', 'callAction', 'getMiddleware', 'middleware', '__construct', 'personStore', 'forPrf', 'forInvoice', 'itemForInvoice', 'getQuantity', 'branchExchange'];
                                                                foreach ($bad_method_not_required as $bad_method_not_required_val) {
                                                                    if(($key = array_search($bad_method_not_required_val, $method_new)) !== false){
                                                                            unset($method_new[$key]);
                                                                    }
                                                                }
                                                                foreach ($method_new as $method_name) {
                                                            ?>
                                                            <div class="row skin skin-square" style="display: none;">
                                                                <div class="col-sm-12">
                                                                    <fieldset>
                                                                        <input type="checkbox" id="{{strtolower($after)}}{{$method_name}}" class="secondrole">
                                                                        <label for="{{strtolower($after)}}{{$method_name}}">
                                                                       
                                                                        <?php
                                                                        switch ($method_name) {
                                                                            case 'index':
                                                                                echo '???????????? ???? ??????????????';
                                                                                break;
                                                                            case 'create':
                                                                                echo '??????????';
                                                                                break;
                                                                            case 'show':
                                                                                echo '???????????? ???????? ????????';
                                                                                break;
                                                                            case 'edit':
                                                                                echo '??????????';
                                                                                break;
                                                                                                     
                                                                            default:
                                                                                echo '??????';
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
                                    <h4 class="form-section"><i class="ft-clipboard"></i> ???????????????? ????????????????</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control lopa" for="cmail">??????????</label>
                                        <div class="col-md-9 mx-auto">
                                            <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="?????? ?????? ????????????????"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                	<button type="submit" class="btn btn-primary mr-1">
                                        <i class="la la-check-square-o"></i> ??????????
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="ft-x"></i> ??????????
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

        $('.select2').select2({
            placeholder: "???????? ???????????? / ??????????"
        });

        var date = new Date();
        var date_now = date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
        var time_now = date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds();
        $('.code').text("SYSU-"+date_now+"-"+time_now);

        var modules;
        var roles = [];
        var permissions = [];

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
            var form = $(this)[0];
            var formdata = new FormData(form);
            formdata.append('code', $('.code').text());
            formdata.append('permissions', JSON.stringify(permissions));
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                url: "{{route('user.store')}}",
                processData: false,  // Important!
                contentType: false,
                cache: false,
                data: formdata, // here $(this) refers to the ajax object not form
                dataType: "JSON",
                beforeSend:function(){
                    
                },
                //enctype: 'multipart/form-data',
                success: function (data) {

                    form.reset();


                    toastr.info('?????? ????????', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true, timeOut: 1000, fadeOut: 1000, onHidden: function () { window.location.reload(); }  });
                    
                },
            });
        });
	</script>
@endsection