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
                                                <select  id="Offer_Type" class="form-control">
                                                   <option value="">Select Offer</option>
                                                   <option value="NormalOffer">Normal Offer</option>
                                                   <option value="SpecialOffer">Special Offer</option>
                                                </select>
                                                <span id="errorgender_dent"></span>
                                                </div><br><br>
                                            </div>
                                            
                                             
                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                     <a onclick="" class="btn btn-primary">
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
        


        <!-- Footer -->
        @include('pageLinks.footer')
      

    </div>
    <!-- /.container -->

</body>

</html>
