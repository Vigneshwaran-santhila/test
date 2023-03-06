@extends('layout')


@section('content')

<div class="container">

    

  

    <a href="invoice/1"><button class="btn btn-info" style="margin-left: 100%;margin-top: 1%;display:none;" >Invoice</button></a>
    </div>



<form style="width: 30%;margin-left: 35%;" id="frm_pro" name="frm_pro">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Category</label>
    <select class="form-control" id="catpro">

      <option value="0">Select an Option</option>
      
    </select>
  </div>
   <input type='hidden' id="num">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Sub Category</label>
    <select class="form-control" id="sub_cat" placeholder="selectoption">

      <option >Select An Option</option>
      
    </select>
  </div>
   <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" class="form-control" id="pro_name" name="pro_name" placeholder="Enter the product name">
  </div>
   <div class="form-group">
    <label for="exampleFormControlInput1">Price</label>
    <input type="number" class="form-control" id="pro_price" name="pro_price"  min="1" max="500" placeholder="Enter the price">
  </div>
  <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
</form>


 <center> <table id='table1' class="table" style='width:86%'>
        <thead>
            <th  scope="col">ID</th>
            <th  scope="col">Category</th>
            <th  scope="col">Sub Category</th>
            <th  scope="col">Product Name</th>
            <th  scope="col">Product Price</th>
            <th  scope="col">Edit</th>
            <th  scope="col">Delete</th>
        </thead>
        <tbody>
             @isset($data)
            @foreach($data as $datas)
            <tr id="{{ 'r'.$datas->id }}">
                <td>{{ $datas->id }}</td>
                <td>{{ $datas->category }}</td>
                <td>{{ $datas->sub_category }}</td>
                <td>{{ $datas->pro_name }}</td>
                <td>{{ $datas->pro_price }}</td>
                <td><button class="btn btn-success" name="edit" id="{{ $datas->id }}">Edit</button></td>
                <td><button class="btn btn-danger"  id="{{ $datas->id }}">Delete</button></td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table></center>
	


@endsection

<script src="assets/jquery.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script> -->




<script>

$(document).ready(function(){

	// validation


// $('#form').submit(function(e) {
//     if ($.trim($("#pro_name, #pro_price").val()) === "") {
//         e.preventDefault();
//         alert('you did not fill out one of the fields');
//     }
// });
	



	// validation end

	$.ajax({

		url:'catdatapro',
		type:'post',
		success:function(data){

			$.each(data,function(key,value){

				for(var i=0;i<value.length;i++){

					var cate = value[i]['category'];
					var id = value[i]['id'];

						$('#catpro').append($('<option>', {value:id, text:cate}));

					//console.log(cate);
				}

			});

		}
	});

	$('#catpro').change(function(){

		var cat_id = $("#catpro option:selected").val();

		//console.log(cat_id);
		// $("#sub_cat").empty();
		 $('#sub_cat').empty().append($('<option></option>').val('Select sub_cat').html('Select the option'));

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

						$('#sub_cat').append($('<option>', {value:id, text:cate}));

					
				}


			});
			
			//console.log(data);

		}
	});


	});


	


  $(document).on('click','#submit',function(event){

	event.preventDefault();

    if($("#catpro option:selected").val() == 0 ){
                    alert('please select the category');
                    //location.reload(true);
                     return false;
                }




			 var categoryes = $("#catpro option:selected").val();

			 var categorytext = $("#catpro option:selected").text();

			 var subcategoryes = $("#sub_cat option:selected").val();

			 var subcategorytext = $("#sub_cat option:selected").text();

			 var proname = $("#pro_name").val();


			 var proprice = $("#pro_price").val();



	$.ajax({

		url:'product_insert',
		type:'post',
		data:{
			cat : categoryes,
			cattext : categorytext,
			subcat : subcategoryes,
			subcattext : subcategorytext,
			prona : proname,
			proprices : proprice






			
		},
		success:function(data){

			
			// table


			$.each(data,function(key,value){

                                        // $('#add').html(value[0][id="add"]);
                                    // alert(value[0]['category'])

                        var row= ''

                        var rid = value[0]["id"];




                        row +='<tr id=r'+rid+'><td>'+value[0]["id"]+'</td><td>'+value[0]["category"]+'</td><td>'+value[0]["sub_category"]+'</td><td>'+value[0]["pro_name"]+'</td><td>'+value[0]["pro_price"]+'</td><td><button class="btn btn-success" name="edit" id='+rid+' >edit</button></td><td><button class="btn btn-danger" id='+value[0]["id"]+'>delete</button></td></tr>'



                                $('tbody').append(row);


                                });




			

			// table end


			//console.log(data);


			$( '#frm_pro' ).each(function(){
    			this.reset();
			});


			

		}
	});


	// $("#frm_pro")get(0).reset()
	// $('#sub_cat').val('');
	// $('#sub_cat option').text('Select an Option'); 


});

  // product update


   $(document).on('click','.btn-success',function(event){


  	event.preventDefault();

  	var idu =  this.id

  		//alert(idu);

  		 var u = 'update'

  		       $.ajax({
                        url:'product_update',
                        type:'post',
                        data:{
                            id:idu,
                            sta:u

                        },

                        success:function(data){

                          
                               
                         // console.log(data);



                                  $.each(data,function(key,value){

                                   


                                          $('#pro_name').val(value[0]['pro_name']);
                                           $('#pro_price').val(value[0]['pro_price']);
                                            $('#num').val(value[0]['id']); 
                                            // $('#catpro option:selected').text(value[0]['category']);
                                             $('option:contains(' + value[0]["category"] + ')').attr('selected', true); 
                                            $('option:contains(' + value[0]["sub_category"] + ')').attr('selected', true); 
                                           
                                         

                                });



                                   $("#submit").html('update');
                                   $('#submit').attr('id','update'); 
                                    $('#frm_pro').attr('id','formup'); 





                                 




                                
                          

                            

                           

                        }




                    });


  	



  });

   // product update end


   // product update true

   $(document).on('click','#update',function(event){

   	event.preventDefault();

   	var category = $('#catpro option:selected').text();

   	var category_id	= $('#catpro option:selected').val();

   	var sub_category = $('#sub_cat option:selected').text();

   	var sub_category_id	= $('#sub_cat option:selected').val();

   	var product_name =	$('#pro_name').val();

   		var pro_price =	$('#pro_price').val();

   		var num =	$('#num').val();


   	                   $.ajax({
                        url:'product_updatetrue',
                        type:'post',
                        data:{
                        	category:category,
                            category_id:category_id,
                            sub_category:sub_category,
                            sub_category_id:sub_category_id,
                            product_name:product_name,
                            pro_price:pro_price,
                            num:num


                        },

                        success:function(data){


                               $.each(data,function(key,value){

   


                        //       console.log(value[0]['category'];
                        //          console.log(value[0]['remarks']);
                        //        console.log( value[0]['id']);


                                var txtc = value[0]['category'];
                                 var txtsc = value[0]['sub_category'];
                                 var txtr = value[0]['pro_name'];
                                 var txtpr = value[0]['pro_price'];


                        $('#r'+value[0]['id']).find("td:eq(1)").text(txtc);

                        $('#r'+value[0]['id']).find("td:eq(2)").text(txtsc);

                         $('#r'+value[0]['id']).find("td:eq(3)").text(txtr);

                         $('#r'+value[0]['id']).find("td:eq(4)").text(txtpr);

                                // currentRow. find("td:eq(2)")


                    // $('#table1 #r'+value[0]['id']).find("td:eq(2)").text(txt);


                            
                            
         

                         });





					


                                  
                 
                    $("#update").html('submit');
                    $('#update').attr('id','submit'); 
                    $('#formup').attr('id','frm_pro'); 
               			$(" option:selected").removeAttr("selected");
                        $('#catpro').empty().append('<option selected="selected" value="test">select the option</option>');
                     $('#sub_cat').empty().append('<option selected="selected" value="test">select the option</option>');
                     $( '#frm_pro' ).each(function(){
    								this.reset();
										});
                  

                  					}




                    });




   									
   									



    

   });

   // product update true






  

  $(document).on('click','.btn-danger',function(event){

  	event.preventDefault();
  	 var idt = this.id;

  	 $('#r'+this.id).hide(function(){

                       
                        var s = 'delete';

                        


                        $.ajax({
                        url:'product_delete',
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