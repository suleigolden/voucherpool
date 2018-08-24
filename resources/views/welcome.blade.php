@include('pageLinks.headLinks')
<body>
    <!-- Navigation -->
    @include('pageLinks.navmenu')
    
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Simple voucher
                 <small>A voucher pool Developement</small>
                </h1>
                
            </div>
        </div>
        <!-- /.row -->
        <div class="col-md-4">
       <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_1"><i class="fa fa-plus"></i> Generate New Voucher</button>
       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_verify"><i class="fa fa-edit"></i> Ferify Voucher</button>
       </div>
       <div class="col-md-5">
            <div class="col-md-6">
           <input type="text" class="form-control" id="v_Email" placeholder="Email"   required autofocus>
            
<span id="sform_output"></span>
            </div>
            <button type="button" class="btn btn-success" onclick="searchVoucher();"><i class="fa fa-search"></i> Search Voucher</button>
            
      </div>
      <div class="col-md-2">
        <a href="{{ URL('/') }}" class="btn btn-success"><i class="fa fa-search"></i> View all Voucher</a>
      </div>
       <br><br>
                        <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Generate New Voucher</h4>
                                        </div>
                                        <div class="panel-body">
                                             <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">Name</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="u_name" placeholder="Name"   required autofocus>
                                                <span id="errorf_name"></span>
                                                </div><br><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">Email</label>

                                                <div class="col-md-6">
                                                    <input  type="text" class="form-control" id="emailAddress" placeholder="Email Address"   required autofocus>
                                                 <span id="errorl_email"></span>
                                                </div><br><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">Offer Type</label>
                                                <div class="col-md-6">
                                                <select  id="Offer_Type" class="form-control" onchange="setDiscount();">
                                                   <option value="">Select Offer</option>
                                                   <option value="NormalOffer">Normal Offer</option>
                                                   <option value="SpecialOffer">Special Offer</option>
                                                </select>
                                                <span id="errorgender_dent"></span>
                                                </div><br><br>
                                            </div>
                                            <div id="percentagediscount">
                                            </div>
                                             
                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                     <a onclick="generateCode();" class="btn btn-primary">
                                                        Generagte Code
                                                    </a>
                                                    <span id="form_output"></span>
                                                </div>
                                            </div>
                                            <div class="writeinfo"></div> 
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                         
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                
                            </div>

                            <div class="modal fade" id="myModal_verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Verify Voucher Code</h4>
                                        </div>
                                        <div class="panel-body">
                                             <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">Voucher Code</label>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="v_Code" placeholder="Voucher Code"   required autofocus>
                                                <span id="errorf_code"></span>
                                                </div><br><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-md-4 control-label">Email</label>

                                                <div class="col-md-6">
                                                    <input  type="text" class="form-control" id="vemailAddress" placeholder="Email Address"   required autofocus>
                                                 <span id="errorl_email"></span>
                                                </div><br><br>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                     <a onclick="verifyvouvherCode();" class="btn btn-primary">
                                                        Verify Code
                                                    </a>
                                                    <span id="vform_output"></span>
                                                </div>
                                            </div>
                                            <div class="writeinfo"></div> 
                                    </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                         
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                
                            </div>


        <div class="row">
            <div class="panel panel-default">
                       
                        <div class="panel-body">
                        
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Offer Type</th>
                                            <th>Voucher Code</th>
                                            <th>Status</th>
                                            <th>Date Used</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultOutPut">
                                        @foreach($recipients as $recipient)
                                        <tr id="updateRec{{ $recipient->recipientID }}">
                                        <th>{{ $recipient->name }}</th>
                                        <th>{{ $recipient->email }}</th>
                                        <th>{{ $recipient->recipientType }}</th>
                                        <th>{{ $recipient->code }}</th>
                                            @if($recipient->date_of_usage == " ")
                                                <th><label class="btn btn-danger"><i class="fa fa-close"></i></label></th>
                                            @else
                                                <th><label class="btn btn-success"><i class="fa fa-check"></i></label></th>
                                            @endif
                                        
                                        <th>{{ $recipient->date_of_usage }}</th>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                       
                    </div>
        </div>
        <hr>
        
<script type="text/javascript">
//function to generate voucher code
function generateCode(){
    // Cariables to need to send to route (Web.php file)
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var uName = $("#u_name").val();
    var emailAdd = $("#emailAddress").val();
    var offer_Type = $("#Offer_Type").val();
    var fDiscount = $("#FixedPercentageDiscount").val();
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "post_Generaate_Code";

     var vars = "_token="+CSRF_TOKEN+"&Name="+uName+"&Email="+emailAdd+"&offerType="+offer_Type+"&fDiscount="+fDiscount;
   
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var return_data = JSON.parse(hr.responseText);
        // console.log(return_data);
        // console.log(return_data.recipientID);
        // console.log(return_data['recipientID']);

            if(return_data.recipientID){
                $('#form_output').html('<hr><div class="alert alert-success">Code Generated Successful</div>');
                $("#resultOutPut").prepend('<tr id="updateRec'+return_data.recipientID+'"> <th>'+return_data.name+'</th><th>'+return_data.email+'</th><th>'+return_data.recipientType+'</th><th>'+return_data.code+'</th><th><label class="btn btn-danger"><i class="fa fa-close"></i></label></th><th>'+return_data.date_of_usage+'</th></tr>');
                $("#u_name").val('');
                $("#emailAddress").val('');
                $("#Offer_Type").val('');
                $("#form_output").fadeOut(9000);
           }else if(return_data.emailexists){
                $('#form_output').html('<hr><div class="alert alert-danger">'+return_data.message+'</div>');
           }else{
            checkValidation(return_data.error.Name,"form_output");
            checkValidation(return_data.error.Email,"form_output");
            checkValidation(return_data.error.offerType,"form_output");
           }

    }else{
        // var return_data = JSON.parse(hr.responseText);
        // console.log(return_data);
    }
}
// Send the data to to route (Web.php file).. and wait for response to update the form_output div message
     hr.send(vars); // Execute the request
     $("#form_output").fadeIn(100);
     $('#form_output').html('<hr><div class="alert alert-warning">Generating Voucher Code, please waite.......</div>');

}

//function to view and set the Fixed Percentage Discount
function setDiscount(){
    var offerType = $("#Offer_Type").val();
    if(offerType == "SpecialOffer"){
        $('#percentagediscount').html('<div class="form-group"><label for="name" class="col-md-4 control-label">Fixed Percentage Discount</label><div class="col-md-6"><input  type="number" class="form-control" id="FixedPercentageDiscount" placeholder="Fixed Percentage Discount" required autofocus><span id="FixedDiscountMessage"></span></div><br><br></div>');
    }else{
      $('#percentagediscount').html('');
    }
  }
//Check Input field validations
function checkValidation(value,form_output){
    if (value) {
        $('#'+form_output).append('<div class="alert alert-danger">'+value+'</div>');
         return false;
     }else{
        return true;
    } 
}
//function to verify voucher code via HTTP
function verifyvouvherCode(){
    // Cariables to need to send to route (Web.php file)
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var uCode = $("#v_Code").val();
    var emailAdd = $("#vemailAddress").val();
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "post_Verify_voucher_Code";

     var vars = "_token="+CSRF_TOKEN+"&VoucherCode="+uCode+"&Email="+emailAdd;
   
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var return_data = JSON.parse(hr.responseText);
        // console.log(return_data);
        // console.log(return_data.recipientID);
        // console.log(return_data['recipientID']);
        if(return_data.emailexists){
                $('#vform_output').html('<hr><div class="alert alert-danger">'+return_data.message+'</div>');
           }else if(return_data.codeexists){
                $('#vform_output').html('<hr><div class="alert alert-danger">'+return_data.message+'</div>');
           }else if(return_data.ValidateTrue){
                $('#vform_output').html('<hr><div class="alert alert-success">'+return_data.message+'</div>');
           }else{
            checkValidation(return_data.error.VoucherCode,"vform_output");
            checkValidation(return_data.error.Email,"vform_output");
           }
          
    }
}
// Send the data to to route (Web.php file).. and wait for response to update the vform_output div message
     hr.send(vars); // Execute the request
     $("#vform_output").fadeIn(100);
     $('#vform_output').html('<hr><div class="alert alert-warning">Verifying Voucher Code, please waite.......</div>');

}
//function to search for voucher using email
function searchVoucher(){
    // Cariables to need to send to route (Web.php file)
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var emailAdd = $("#v_Email").val();
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    var url = "post_Search_voucher_Code";

     var vars = "_token="+CSRF_TOKEN+"&Email="+emailAdd;
   
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
      if(hr.readyState == 4 && hr.status == 200) {
        var return_data = JSON.parse(hr.responseText);
        if(return_data.recipientID){
                $('#sform_output').html('');
                $("#resultOutPut").html('<tr id="updateRec'+return_data.recipientID+'"> <th>'+return_data.name+'</th><th>'+return_data.email+'</th><th>'+return_data.recipientType+'</th><th>'+return_data.code+'</th><th><label class="btn btn-danger"><i class="fa fa-close"></i></label></th><th>'+return_data.date_of_usage+'</th></tr>');
                $("#u_name").val('');
                $("#emailAddress").val('');
                $("#Offer_Type").val('');
                $("#form_output").fadeOut(9000);
           }else{
            $('#sform_output').html('<i style="color:#F00;">Invalid Email</i>');
           }
        
    }
}
// Send the data to to route (Web.php file).. and wait for response to update the vform_output div message
     hr.send(vars); // Execute the request
     $("#sform_output").fadeIn(100);
     $('#sform_output').html('<i style="color:green;">Searching...</i>');

}
</script>

        <!-- Footer -->
        @include('pageLinks.footer')
      

    </div>
    <!-- /.container -->

</body>

</html>
