@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <style type="text/css">
        #invoice-POS{ box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); padding:4mm 2mm; margin: 0 auto; width: 54mm; background: #fff; } 
        ::selection {background: #f31544; color: #FFF;}
        ::moz-selection {background: #f31544; color: #FFF;}
        #invoice-POS h2{font-size: .9em;}
        #invoice-POS h3{ font-size: 1.2em; font-weight: 300; line-height: 2em; }
        #invoice-POS p{ font-size: .7em; color: #666; line-height: 1.2em; width: 100%; }
        .info{ display: block; margin-left: 0; }
        .title{ float: right; }
        .title p{text-align: right; } 
        table{ width: 100%; border-collapse: collapse; }
        .tabletitle{ font-size: .7em; background: #eee; }
        .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single, input[type="number"], input[type="text"]{ border: none !important; background: none !important; }
        #invoice-POS td, #invoice-POS th{ font-family: 'Tajawal', sans-serif !important; font-weight: 500 !important; padding: 8px 5px; }
        #invoice-POS td p{ margin-bottom: 0;  }




/*#invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ 
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  float: left;
    height: 60px;
    width: 60px;
    background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
    background-size: 60px 60px;
}
.clientlogo{
  float: left;
    height: 60px;
    width: 60px;
    background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
    background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  float:left;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}*/

  
  



        @media print
        {
            .non-printable { visibility:hidden; }
            .printable { visibility:visible; }
            .tabletitle {
                        -webkit-print-color-adjust: exact; 

                background: #eee !important;
                }
        }
    </style>
@endsection

@section('content')
    <section class="card">
        <div id="invoice-template" class="card-body p-4">
            <form class="form form-horizontal emad" novalidate>
                <div id="invoice-company-details" class="row">
                    <div class="col-sm-4 col-12 text-center text-sm-left">
                        <div class="media row">
                            <div class="col-12 col-sm-3 col-xl-3">
                                <img src="{{asset('app-assets/images/logo/logo-dark.png')}}" alt="" style="max-width: 100%;" class="mb-1 mb-sm-0">
                            </div>
                            
                        </div>
                    </div>
                   

                    <div class="col-sm-4 col-12 text-center text-sm-center">
                        <h2>????????????</h2>
                        <p class="pb-sm-3 codegen" style="direction: ltr;"></p>

                    </div>

                     <div class="col-sm-4 col-12 text-center text-sm-right">
                                <p class="text-muted">?????????? ???????????????? : <span class="date"></span></p>
                            </div>
                </div>

                <div id="invoice-customer-details" class="row pt-2">
                    
                    <div class="col-sm-4 col-12 text-center text-sm-center">
                        <p class="text-muted">???????????? ????????????</p>
                        <ul class="px-0 list-unstyled form-group mx-auto">
                            <li class="text-bold-800 controls">
                                <select class="select2 form-control" id="employee" name="employee" required data-validation-required-message="?????? ?????????? ??????????">
                                    <option></option>
                                    @foreach($employees as $employee)
                                        @if($employee->user->id === Auth::id())
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li id="employee_code"></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-12 text-center text-sm-center">
                        <p class="text-muted">???????????? ????????????</p>
                        <ul class="px-0 list-unstyled form-group mx-auto">
                            <li class="text-bold-800 controls">
                                <select class="select2 form-control" id="tree" name="tree" required data-validation-required-message="?????? ?????????? ??????????">
                                    <option></option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li id="client_tel"></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-12 text-center text-sm-center">
            
                        <p class="text-muted">?????????? ??????????</p>
               
                            
                        <select class="select2 form-control" id="treetype" name="treetype" required data-validation-required-message="?????? ?????????? ??????????">
                            <option></option>
                            <option value="0">??????</option>
                            
                        </select>
               
                    </div>
                </div>

                <div id="invoice-items-details" class="pt-2 repeater-emad">
                <div class="row">
                    <div class="table-responsive col-12">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">???????????? &amp; ??????????????</th>
                                    <th class="text-center">??????????</th>
                                    <th class="text-center">?????? ????????????</th>
                                    <th class="text-center">????????????</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody data-repeater-list="items">
                                <tr data-repeater-item>
                                    <td scope="row">
                                        <input type="text" placeholder="?????? ??????????" name="code" class="form-control code text-left"required data-validation-required-message="This field is required">
                                        <input type="hidden" class="itemid" name="itemid" />
                                    </td>
                                    <td class="text-center">
                                        <p class="desc" style="margin-bottom: auto"></p>
                                        <p class="text-muted category info"></p>
                                    </td>
                                    <td class="text-right">
                                        <input type="text" placeholder="???????? ??????????" name="pquantity" class="form-control pquantity text-center" required data-validation-required-message="This field is required">
                                    </td>
                                    <td class="text-right">
                                        <input type="text" placeholder="?????? ????????????" name="unit" class="form-control unit text-center" /> 
                                    </td>
                                    <td class="text-right">
                                        <input type="text" placeholder="????????????" name="pamount" class="form-control pamount text-center" disabled /> 
                                    </td>
                                    <td ><button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i> ??????</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group overflow-hidden">
                        <div class="col-12">
                            <button id="emre" type="button" data-repeater-create class="btn btn-primary">
                                <i class="ft-plus"></i> ?????? ????????
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7 col-12 text-center text-sm-left">
                        <!-- <h4 class="card-title">?????? ?????????? ( ???? ???????? ?????????? )</h4>
                        <div class="table-responsive repeater-ways">
                            <table class="table">
                                <tbody data-repeater-list="ways">                
                                    <tr data-repeater-item> 
                                        <th scope="row">
                                            <input type="text" placeholder="??????????????" class="form-control text-center method" name="method" style="width: auto; display: inline;" />
                                        </th>
                                        <td>
                                            <input type="number" placeholder="????????????" class="form-control text-center method1" name="method1" style="width: auto; display: inline;" />
                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i> ??????</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group overflow-hidden">
                                <button id="waysid" type="button" data-repeater-create class="btn btn-primary">
                                    <i class="ft-plus"></i> ?????????????? ??????????????
                                </button>
                            </div>
                        </div> -->
                        <!-- -->
                    </div>
                    <div class="col-sm-5 col-12">
                        <p class="lead">???????????? ??????????????</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>??????????????</td>
                                        <td class="text-right">
                                            <input type="number" class="subtotal form-control text-right" name="subtotal" style="padding-top: 0 !important;" disabled="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>??????????</td>
                                        <td class="text-right">
                                            <input type="number" class="tax form-control text-right" name="tax" style="padding-top: 0 !important;" min="0" value="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>??????</td>
                                        <td class="pink text-right">
                                            <input type="number" class="discount form-control text-right" name="discount" style="padding-top: 0 !important;" value="0" />
                                        </td>
                                    </tr>
                                    <tr class="bg-grey bg-lighten-4">
                                        <td class="text-bold-800">???????????? ??????????????</td>
                                        <td class="text-bold-800 text-right">
                                            <input type="number" class="gtotal form-control text-right" name="gtotal" style="padding-top: 0 !important;" disabled="">
                                            <input type="hidden" id="hid" name="hid" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>

                <div id="invoice-footer">
                    <div class="row">
                        <div class="col-sm-7 col-12 text-center text-sm-left"></div>
                        <div class="col-sm-5 col-12 text-center">
                            <button type="submit" class="btn btn-info btn-print btn-lg my-1"><i class="la la-paper-plane-o mr-50"></i>?????????? ????????????</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade text-left" id="print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">???????????? ???????????? ????????????????</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center printable">

                    <div id="invoice-POS">
                        <div class="row">
                            <div class="col-sm-12 col-12 text-center">
                                <img src="{{asset('app-assets/images/logo/logo-dark.png')}}" alt="" style="max-width: 30%;" class="mb-1 mb-sm-0">
                                <h2 style='padding-top: 10px;'>?????????????? ?????????????????? ????????????????</h2>
                                <p class="codegen" style="direction: ltr; border-bottom: 1px solid #0000002e; padding-bottom: 5px;"></p>
                            </div>
                        </div>
                        <div class="row text-left" style="margin: auto;">
                            <p id="sales" style="margin-bottom: 5px;">???????????? : ???????? ????????????</p>
                            <p class="text-muted">?????????? ???????????????? : <span class="date"></span></p>
                            
                        </div>
                        <div class="row text-center"  style="margin: auto;">
                            <p id="client" style="margin-bottom: 5px; border-bottom: 1px solid #0000002e; border-top: 1px solid #0000002e; padding: 5px 0;">???????????? : ???????? ???????????? - (??????)</p>
                  
                        </div>
                        <div class="row text-left" style="margin: auto;">
                            <table>
                                <thead>
                                    <tr class="tabletitle">
                               
                                        <th>#</th>
                                        
                                        <th>?????? ??????????</th>
                                        <th>??????????</th>
                                        <th>????????????????</th>
                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr class="service">
                                        <td class="tableitem"><p class="itemtext">1</p></td>
                                        <td class="tableitem"><p class="itemtext">???????? ??????????</p></td>
                                        
                                        <td class="tableitem"><p class="itemtext">120</p></td>
                                        <td class="tableitem"><p class="itemtext">120</p></td>
                                    </tr>
                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">1</p></td>
                                        <td class="tableitem"><p class="itemtext">???????? ??????????</p></td>
                                        
                                        <td class="tableitem"><p class="itemtext">120</p></td>
                                        <td class="tableitem"><p class="itemtext">120</p></td>
                                    </tr>
                                    <tr class="service" style="border-top: 1px solid #0000002e;">
                                        <td class="Rate" colspan="2"><p>??????????????</p></td>
                                        <td class="payment text-right" colspan="2"><p>240 ??.??</p></td>
                                    </tr>
                                    <tr class="service" style="border-top: 1px solid #0000002e;">
                                        <td class="Rate" colspan="2"><p>??????????????</p></td>
                                        <td class="payment text-right" colspan="2"><p>240 ??.??</p></td>
                                    </tr>
                                    <tr class="tabletitle">
                                        <td class="Rate" colspan="2">????????????????</td>
                                        <td class="payment text-right" colspan="2">240 ??.??</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="row" style="margin: auto;">
                            <div id="legalcopy" style="border-top: 1px solid #0000002e; border-bottom: 1px solid #0000002e; padding-top: 10px;">
                                <p class="legal"><strong>???????????? ?????? ?????????? ?????????????? </strong><span style="display: block;">?????????????? ?????????????? ?????????? ?????????? ?????????????????? ???????? 14 ?????? ???? ?????????? ???????????? </span>
                                </p>
                            </div>
                            <p style="margin-bottom: 0; padding-top: 10px;" class="text-right">Powered by KeenDeer.com</p>
                        </div>
                        <!--<center id="top" >
                          <img src="{{asset('app-assets/images/logo/logo-dark.png')}}" alt="" style="max-width: 30%;" class="mb-1 mb-sm-0">
                          <div class="info"> 
                            <h2 style='padding-top: 5px;'>?????????????? ?????????????????? ????????????????</h2>
                            <p class="codegen" style="direction: ltr;"></p>
                            
                          </div>
                        </center>End InvoiceTop-->

                        <!--<div id="mid">
                          <div class="info">
                            <p> 
                                ???????????? / ???????? ????????????
                            <br />
                                ???????????? / ???????? ????????????
                            </p> 
                            <p class="text-muted">?????????? ???????????????? : <span class="date"></span></p>
                          </div>
                        </div>End Invoice Mid-->

                        <!--<div id="bot">-->
                            <!--<div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>??????????</h2></td>
                                <td class="Hours"><h2>????????????</h2></td>
                                <td class="Rate"><h2>??????????</h2></td>
                            </tr>

                            <tr class="service">
                                <td class="tableitem"><p class="itemtext">578</p></td>
                                <td class="tableitem"><p class="itemtext">1</p></td>
                                <td class="tableitem"><p class="itemtext">120</p></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>??????????????</h2></td>
                                <td class="payment"><h2>15</h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>????????????????</h2></td>
                                <td class="payment"><h2>250</h2></td>
                            </tr>

                        </table>
                    </div>End Table-->


                            
                        <!-- </div> -->

                    </div>
  



                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="print btn btn-outline-primary">??????????</button>
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">??????????</button>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('footer-bottom')
    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    <script type="text/javascript">
        $('.select2').select2({
            placeholder: "???????? ????????????"
        });

        $('#employee').select2({
            placeholder: "???????? ????????????"
        });

        $('#treetype').select2({
            placeholder: "???????? ?????????? ??????????"
        });

        var newgtotal = 0;
        var MyDate = new Date();
        var MyDateString;
        MyDate.setDate(MyDate.getDate());
        var seconds = MyDate.getSeconds();
        var minutes = MyDate.getMinutes();
        var hour = MyDate.getHours();
        var hour_after = hour > 12 ? hour - 12 : hour;
        var am_pm = hour >= 12 ? "pm" : "am";
        MyDateString = MyDate.getFullYear().toString().substr(-2)+'-'+('0' + (MyDate.getMonth()+1)).slice(-2)+'-'+('0' + MyDate.getDate()).slice(-2)+'-'+hour+'-'+minutes+'-'+seconds;

        var gen = "# INVOICE-"+MyDateString;

        $('.codegen').text(gen);
        $('.date').text(('0' + MyDate.getDate()).slice(-2)+'/'+('0' + (MyDate.getMonth()+1)).slice(-2)+'/'+MyDate.getFullYear().toString()+" - "+hour_after+":"+minutes+am_pm);

        $('#tree').on('change', function(){
            var id = $(this).val();
            var url = "{{route('client.show', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({  
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'GET',
                url: url,
                dataType: "JSON",
                success: function (data) {
                    $('#client_tel').text("?? : "+data.success.tel);
                    if(data.success.type===0){
                        $('#treetype').append("<option value='1'> ??????</option>");
                    }else{
                        $('#treetype').find('option').remove().end().append('<option value="0">??????</option>');
                    }
                },
            }); 
        });

        var $emadSelect = $(".code");

        $emadSelect.on("keyup change", function (e) {

            var code = $(this).val();
           
            
            $.ajax({  
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                url: "{{route('item.itemForInvoice')}}",
                dataType: "JSON",
                data: {
                    "code": code,
                    "_method": 'GET'
                  
                },
                success: function (data) {
                    $emadSelect.closest('tr').find('.itemid').val(data.item.id); 
                    $emadSelect.closest('tr').find('.desc').html(data.item.name); 
                    $emadSelect.closest('tr').find('.category').html(data.category); 
                    $emadSelect.closest('tr').find('.unit').val(data.item.gprice);        
                },
            });   
        });

        $(".pquantity").on("keyup change", function (e) {
 
            var $unit = $(this).closest('tr').find('.unit').val();
            var $pamount = $(this).closest('tr').find('.pamount');
            $pamount.val($unit*$(this).val());

            var sum10 = 0;

            $('.pamount').each(function(){
                sum10 += +$(this).val();
            });

            $(".subtotal").val(Number(sum10).toFixed(2));
            $(".gtotal").val($('.subtotal').val());

            newgtotal = $(".gtotal").val();
        });
        /*****/

         var barcode="";
        $(document).keydown(function(e) 
        {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                $('#emre').click();
            }else if(code==9){
                $('#emre').click();
            }
            else{
                
            }
        });

         $('.repeater-emad').repeater({
            show: function () {
                $(this).slideDown();
                var $yaraSelect = $(this).find('.code');
                $yaraSelect.on("keyup", function (e) {
                    var code = $(this).val();
                    var url = "{{route('item.show', ':code')}}";
                    url = url.replace(':code', code);
                    $.ajax({  
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: "{{route('item.itemForInvoice')}}",
                        dataType: "JSON",
                        data: {
                            "code": code,
                            "_method": 'GET'
                          
                        },
                
                        success: function (data) {
                            $yaraSelect.closest('tr').find('.itemid').val(data.item.id);
                            $yaraSelect.closest('tr').find('.desc').html(data.item.name); 
                            $yaraSelect.closest('tr').find('.category').html(data.category); 
                            $yaraSelect.closest('tr').find('.unit').val(data.item.gprice);        
                        },
                    });   
                });

                var yara1Select = $(this).find('.pquantity');
                yara1Select.on("keyup change", function (e) {
                    
                    var $unit = $(this).closest('tr').find('.unit').val();
                    var $pamount = $(this).closest('tr').find('.pamount');
                    $pamount.val($unit*$(this).val());


                    var sum10 = 0;

                    $('.pamount').each(function(){
                        sum10 += +$(this).val();
                    });
                    $(".subtotal").val(Number(sum10).toFixed(2));
                    $(".gtotal").val($('.subtotal').val());
                    newgtotal = $(".gtotal").val();
                });
            },
            hide: function(remove) {
                if (confirm('Are you sure you want to remove this item?')) {
                    $(this).slideUp(remove);       
                }
            }
         });




        $('.repeater-ways').repeater({
            show: function () {
                $(this).slideDown();
              
                
            },
            hide: function(remove) {
                if (confirm('Are you sure you want to remove this item?')) {
                    $(this).slideUp(remove);       
                }
            }
         });





        $('.tax').on("keyup change", function(e){
            $(".gtotal").val(Number($('.subtotal').val())+Number($('.subtotal').val()*($(this).val()/100)));
            newgtotal = $(".gtotal").val();
        });

        $('.discount').on("keyup change", function(e){ 
            $('.gtotal').val(Number(newgtotal-$(this).val()));
        });

        $(".emad").submit(function(stay){
     
            stay.preventDefault();
            var myFormObj = $(".repeater-emad").repeaterVal();
            var myFormJson = JSON.stringify(myFormObj);
            //var codegen = $('.codegen').text();
            var tax = $('.tax').val();
            var discount = $('.discount').val();
            var gtotal = $('.gtotal').val();
            var client_id = $('#tree').val();
            var employee_id = $('#employee').val();
            //alert(codegen);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('salesorder.store') }}",
                method: "POST",
                dataType: "JSON",
                data: {
                    "codegen": gen,
                    "tax": tax,
                    "discount": discount,
                    "myFormJson" : myFormObj,
                    "gtotal": gtotal,
                    "client_id": client_id,
                    "employee_id": employee_id,
                 
                },
                
                beforeSend:function(){
                    $("#sales").text('???????????? / '+$( "#employee option:selected" ).text());
                    $("#client").text('???????????? / '+$( "#tree option:selected" ).text()+'('+$( "#treetype option:selected" ).text()+')');
                    
                    $.each( myFormObj.items, function( key, value ){
                        $("#print table tbody").append('<tr class="service"><td class="tableitem"><p class="itemtext">'+value.pquantity+'</p></td><td class="tableitem"><p class="itemtext">'+value.code+'</p></td><td class="tableitem"><p class="itemtext">'+parseFloat(value.unit).toFixed(2)+'</p></td><td class="tableitem"><p class="itemtext">'+parseFloat(value.pamount).toFixed(2)+'</p></td></tr>')
                    });

                    $("#print table tbody").append('<tr class="service" style="border-top: 1px solid #0000002e;"><td class="Rate" colspan="2"><p>??????????????</p></td><td class="payment text-right" colspan="2"><p>'+$('.subtotal').val()+' ??.??</p></td></tr><tr class="service" style="border-top: 1px solid #0000002e;"><td class="Rate" colspan="2"><p>??????????????</p></td><td class="payment text-right" colspan="2"><p>'+tax+' %</p></td></tr><tr class="service" style="border-top: 1px solid #0000002e;"><td class="Rate" colspan="2"><p>?????? ??????????</p></td><td class="payment text-right" colspan="2"><p>'+parseFloat(discount).toFixed(2)+' ??.??</p></td></tr><tr class="tabletitle"><td class="Rate" colspan="2">???????????? ??????????????</td><td class="payment text-right" colspan="2">'+parseFloat($('.gtotal').val()).toFixed(2)+' ??.??</td></tr>');

                    $("#print").modal("show");
                    
                    
                },
                success: function (data) {
                    toastr.info('?????? ????????', data.success, { positionClass: 'toast-bottom-left', "showMethod": "slideDown", "hideMethod": "slideUp", "progressBar": true });
                },
            });
        });
        $('.print').on('click', function(){
            window.print();
        });

        $('#print').on('hidden.bs.modal', function () {
            window.location.reload();
        });
    </script>
@endsection 