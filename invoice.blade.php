@extends('layout')



@section('content')


	
	<!-- Button trigger modal -->
<button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="adduser"style="margin-left: 87%;margin-top: 1%;">
 Add Invoice
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog"style="max-width: 98%;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class=".g-col-md-12">
        	<form id="frm" style="max-width: 40%;">
        		<div class="mb-3">
        		
        	<p id="in_num"> </p>

        	<p id="in_date"> </p>
        		
        		
				    <label for="name">Customer Name</label>
				    <input type="text" class="form-control" id="name" name="name">
				</div>
				<div class="mb-3">
				    <label for="name" class="form-label">Customer Phone Number</label>
				    <input type="text" class="form-control" id="phone_number" name="phone_number">
				</div>
				<div class="mb-3">
				    <label for="name" class="form-label">Customer Remarks</label>
				    <input type="text" class="form-control" id="remarks" name="remarks">
				</div>
			</div>
			<input type="hidden" value="" id="in_number">
			<input type="hidden" value="" id="pro_number">
		</div>
      

      <center > <table id='table1' class="table" style='width:86%'>
        <thead>
            
            <th  scope="col">Category</th>
            <th  scope="col">Sub Category</th>
            <th  scope="col">Product Name</th>
            <th  scope="col">Product Price</th>
            <th  scope="col">Qty</th>
             <th  scope="col">Total</th>
             <th  scope="col">Action</th>

           
        </thead>
        <tbody>

        	@isset($data)
        	<tr>

        	<!-- category -->
        	<td> <select class="form-control" id="category" name="category">
        		<option  value="0" >Select an Option</option>
      @foreach($data as $datas)
      		

      	
      	 <option value="{{ $datas->id }}">{{ $datas->category }}</option>

      @endforeach
      </select></td>
      <span id="errors"></span>
      <!-- category end-->
       <!-- subcategory -->
      <td> 
      	<select class="form-control" id="sub_category">
      <option value="0" selected disabled hidden>Select an Option</option>
      
      		

      	
      	 <option></option>

      
      </select>
    </td>
      <!-- subcategory end-->
      <!-- product -->
      <td> <select class="form-control" id="pro_name">
      	<option value="0" selected disabled hidden>Select an Option</option>
     
      		

      	
      	 <option></option>

    
      </select></td>
      <!-- product end-->
      <!-- product price -->
      <td> <select class="form-control" id="pro_price">
      	<option value="0" selected disabled hidden>Select an Option</option>
     
      		

      	
      	 <option></option>

     
      </select></td>
      <!-- product price end-->
      <!-- qty  -->
      <!-- <input type="number" name="qty" id="qty"> -->
      <td>
      	<input type="number" name="qty" id="qty" value="0">
      	<!-- <p id="calcul">1</p>
      	<button id="add">+</button>
      	<button id="sub">-</button> -->
      </td>
      <!-- qty   end-->
      <!-- AMOUNT  -->
      <!-- <input type="number" name="qty" id="qty"> -->
      <td>
      	<p id="total">0</p>
      </td>
      <!-- AMOUNTend-->

       <!-- button  -->
      <td><button class="btn btn-primary" id="add"  type="submit">Add</button><br><br></td>
      <!-- button   end-->

    </tr>

      @endisset
        
        	

        
        </tbody>
    </table></center>
     <center> <table id='table2' class="table" style='width:86%'>
        <thead>
            <th  scope="col">ID</th>
            <th  scope="col">Product Category</th>
            <th  scope="col">Sub Category</th>
            <th  scope="col">Product</th>
            <th  scope="col">product Price</th>
            <th  scope="col">Qty</th>
            <th  scope="col">Amount</th>
            <th  scope="col">Edit</th>
            <th  scope="col">Delete</th>
        </thead>
        <tbody>
        </tbody>
    </table></center>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
      </div>
      </form>
      <hr>
     

    </div>
  </div>
</div>

@endsection



<script src="assets/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


<script>


	$(document).ready(function(){


		$('#adduser').click(function(){
				
				$.ajax({
					url:'invoicetd',
					type:'post',
					data:{
						id:1,
							test:'invoice'
						},
					success:function(data){

						 

						$.each(data,function(key,value){

												var data = value['id']

									 $('#in_num').html('Invoice number:'+' '+value['data']);

									  $('#in_date').html('Invoice date:'+' '+value['date']);


									  $('#in_number').val(data);


});
				

					


					}
				});
		});


			$('#category').change(function(){

				var cat_id = $("#category option:selected").val();

				 $('#sub_category').empty().append($('<option></option>').val('Select ').html('Select the option'));

				$.ajax({

		url:'subcatdatapro',
		type:'post',
		data:{
			categoryid:cat_id
		},
		success:function(data){

			$.each(data,function(key,value){

				for(var i=0;i<value.length;i++){

					var cate = value[i]['subcate'];
					var id = value[i]['id'];

						$('#sub_category').append($('<option>', {value:id, text:cate}));

					
				}


			});
			
			//console.log(data);

		}
	});



			});

			// product

							$('#sub_category').change(function(){

				var subcat_id = $("#sub_category option:selected").val();

				 $('#pro_name').empty().append($('<option></option>').val('Select').html('Select the option'));

				$.ajax({

		url:'datapro',
		type:'post',
		data:{
			subcat_id:subcat_id
		},
		success:function(data){

			$.each(data,function(key,value){

				for(var i=0;i<value.length;i++){

					var cate = value[i]['pro_name'];
					var id = value[i]['id'];

						$('#pro_name').append($('<option>', {value:id, text:cate}));

					
				}


			});
			
			//console.log(data);

		}
	});



			});


			// product end


							// product price



							$('#pro_name').change(function(){

				var pro_id = $("#pro_name option:selected").val();

				 $('#pro_price').empty().append($('<option></option>').val('Select').html('Select the option'));

				$.ajax({

		url:'datapropri',
		type:'post',
		data:{
			pro_id:pro_id
		},
		success:function(data){

			$.each(data,function(key,value){

				for(var i=0;i<value.length;i++){

					var cate = value[i]['pro_price'];
					var id = value[i]['id'];

						$('#pro_price').append($('<option>', {value:id, text:cate}));

					
				}


			});
			
			//console.log(data);

		}
	});



			});



							//product price end



							$('#qty').keyup(function(){

								var q = $('#qty').val();

								var pro_pricet = $("#pro_price option:selected").text();

								// var a = q*pro_pricet;

								 $('#total').html(q*pro_pricet);

								

								

								
							});

				


		




			$("#frm").submit(function(e) {

			    e.preventDefault();
			}).validate({
			    rules:{
						name:{
							required:true,
							minlength:5
						},
						phone_number:{
							required:true,
							digits:true,
							maxlength:10,
							minlength:10
						},
						category:{
							required:true

						}
						

					},
					message:{
						name:{
							required:"please enter your name",
							minlength:"please enter atleast 5 charecte"

						},
						phone_number:{
							required:"please enter your phone number",
							maxlength:"enter valid phone number",
							minlength:"please enter valid phone number"
						},
						category:{
							required:"please enter your category"

						}

						

					},
			    submitHandler: function(form) { 



					var name = $('#name').val();

					var phone = $('#phone_number').val();

					var remark = $('#remarks').val();

					var id = $('#in_number').val();

					








					$.ajax({

						url:'invoice_insert',
						type:'post',
						data:{
							name:name,
							phone:phone,
							remark:remark,
							invoice:id
							
						},
						success:function(form){

							
						


						//alert('value submitted');
						



						},
						complete:function(){

										$( '#frm' ).each(function(){
    				this.reset();
    				 $("#exampleModal").modal('hide');
    				  location.reload(true);
			});

										$("#total").text('0');


									




						}
					});







			        
			        return false;  //This doesn't prevent the form from submitting.
			    }
});

			// add

			$(document).on('click','#add',function(event){
				event.preventDefault();

				var cat = $("#category option:selected").text();

				if($("#category option:selected").val() == 0 ){
					alert('please select the category');
					 return false;
				}
			

				var id = $('#in_number').val();

				var c = $("#category option:selected").text();

					var p = $("#pro_name option:selected").text();

					var p_id = $("#pro_name option:selected").val();

					var p_price = $("#pro_price option:selected").text();

					var p_qty = $("#qty").val();

					var p_amt = $("#total").text();

					var p_sub_cat = $("#sub_category option:selected").text();


					// ajax

										$.ajax({

						url:'product_details_insert',
						type:'post',
						data:{
							
							invoice:id,
							cat:c,
							pro:p,
							pro_id:p_id,
							pro_price:p_price,
							pro_qty:p_qty,
							pro_amt:p_amt,
							pro_sub_cat:p_sub_cat
						},
						success:function(form){


								$.each(form,function(key,value){

                                    
                        var row= ''

                        var rid = value[0]["id"];




                        row +='<tr id=r'+rid+'><td>'+value[0]["id"]+'</td><td>'+value[0]["pro_category"]+'</td><td>'+value[0]["sub_cat"]+'</td><td>'+value[0]["product"]+'</td><td>'+value[0]["product_price"]+'</td><td>'+value[0]["qty"]+'</td><td>'+value[0]["amount"]+'</td><td><button class="btn btn-success" name="edit" id='+rid+' >edit</button></td><td><button class="btn btn-danger" id='+value[0]["id"]+'>delete</button></td></tr>'



                                $('#table2 tbody').append(row);


                                });


							// list call end

						//$(" option:selected").removeAttr("selected");

                   //$("#category").text('Select an Option');
								$(" option:selected").removeAttr("selected");
                   //$('option:contains("Select an Option")').attr('selected', true);

                   $("#category")[0].selectedIndex = 0;

								$("#sub_category")[0].selectedIndex = 0;

								$("#pro_name")[0].selectedIndex = 0;

								$("#pro_price")[0].selectedIndex = 0;

								$('#qty').val(0);

						


						



						},
						complete:function(){

							 
										$("#total").text('0');






						}
					});


					// ajax end




				
			});

			// add end

			$(document).on('click','.btn-success',function(event){

				event.preventDefault();
				$( '#frm' ).each(function(){
    				this.reset();
			});
				var idu =  this.id;




  	

  		 var u = 'update'

  		       $.ajax({
                        url:'product_details_update',
                        type:'post',
                        data:{
                            id:idu,
                            sta:u

                        },

                        success:function(data){

                          
                               
                         console.log(data);



                                  $.each(data,function(key,value){

                                   

                                  				$('#pro_number').val(value[0]["id"])
                                        
                                             $('option:contains(' + value[0]["pro_category"] + ')').attr('selected', true);
                                             $('option:contains(' + value[0]["sub_cat"] + ')').attr('selected', true); 
                                            $('option:contains(' + value[0]["product"] + ')').attr('selected', true);

                                             $('option:contains(' + value[0]["product_price"] + ')').attr('selected', true); 

                                             $('#qty').val(value[0]['qty']);

                                             $('#total').text(value[0]['amount']);
                                           
                                         

                                });



                                   $("#add").html('update');
                                   $('#add').attr('id','update'); 
                                    

                                    // $('#update').removeAttr("type").attr("type", "button");





                                 




                                
                          

                            

                           

                        }




                    });


			});

			// update true

			$(document).on('click','#update',function(event){

				event.preventDefault();


					var id = $('#pro_number').val();

					var cust_id = $('#in_number').val();

				var c = $("#category option:selected").text();

					var p = $("#pro_name option:selected").text();

					var p_id = $("#pro_name option:selected").val();

					var p_price = $("#pro_price option:selected").text();

					var p_qty = $("#qty").val();

					var p_amt = $("#total").text();

					var p_sub_cat = $("#sub_category option:selected").text();


					// ajax

														$.ajax({

						url:'product_details_updatetrue',
						type:'post',
						data:{
							
							invoice:id,
							custmr_id:cust_id,
							cat:c,
							pro:p,
							pro_id:p_id,
							pro_price:p_price,
							pro_qty:p_qty,
							pro_amt:p_amt,
							pro_sub_cat:p_sub_cat
						},
						success:function(form){



							console.log(form);


								$.each(form,function(key,value){

                          var txtid = value[0]['id'];          
                        var txtc = value[0]['pro_category'];
                                 var txtsc = value[0]['sub_cat'];
                                 var txtr = value[0]['product'];
                                 var txtpr = value[0]['product_price'];

                                 var txtqty = value[0]['qty'];
                                 var txtamt = value[0]['amount'];

                        $('#r'+value[0]['id']).find("td:eq(0)").text(txtid);

                        $('#r'+value[0]['id']).find("td:eq(1)").text(txtc);

                        $('#r'+value[0]['id']).find("td:eq(2)").text(txtsc);

                         $('#r'+value[0]['id']).find("td:eq(3)").text(txtr);

                         $('#r'+value[0]['id']).find("td:eq(4)").text(txtpr);

                         $('#r'+value[0]['id']).find("td:eq(5)").text(txtqty);

                         $('#r'+value[0]['id']).find("td:eq(6)").text(txtamt);


                                });


							// list call end

							$("#update").html('add');
                    $('#update').attr('id','add'); 

                   $('#pro_number').val('');
							
                   $(" option:selected").removeAttr("selected");



                   //$("#category").text('Select an Option');
                   $('option:contains("Select an Option")').attr('selected', true);
                   //$("#category")[0].selectedIndex = 0;

                //    $("#category")[0].selectedIndex = 0;

								// $("#sub_category")[0].selectedIndex = 0;

								// $("#pro_name")[0].selectedIndex = 0;

								// $("#pro_price")[0].selectedIndex = 0;
						
						



						},
						complete:function(){

										$( '#frm' ).each(function(){
    				this.reset();
			});

										$("#total").text('0');




						}
					});

					// ajax end



			});

			// update true end

$(document).on('click','.btn-danger',function(event){
			event.preventDefault();
			var idt = this.id;

			  	 $('#r'+this.id).hide(function(){

                       
                        var s = 'delete';

                        


                        $.ajax({
                        url:'product_details_delete',
                        type:'post',
                        data:{
                            id:idt,
                            sta:s

                        },

                        success:function(data){

                          
                        console.log(data);
                          

                            

                           

                        }




                    });

                        // ajax end


                      });
				

		});


	});


</script>




</html>