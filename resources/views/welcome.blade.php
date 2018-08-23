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
       <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal_1"><i class="fa fa-edit"></i> Generate New Voucher</button>
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
                                    <tbody>
                                        

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
        console.log(return_data);
        console.log(return_data.recipientID);
        console.log(return_data['recipientID']);

            if(return_data.recipientID){
                $('#form_output').html('<hr><div class="alert alert-success">Code Generated Successful</div>');
                $("#u_name").val('');
                $("#emailAddress").val('');
                $("#Offer_Type").val('');
                $("#form_output").fadeOut(9000);
           }else if(return_data.emailexists){
                $('#form_output').html('<hr><div class="alert alert-danger">'+return_data.message+'</div>');
           }else{
                $('#form_output').html('<hr><div class="alert alert-danger">'+return_data.error.Name+'<br>'+return_data.error.Email+'<br>'+return_data.error.offerType+'</div>');
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
</script>

        <!-- Footer -->
        @include('pageLinks.footer')
      

    </div>
    <!-- /.container -->

</body>

</html>
