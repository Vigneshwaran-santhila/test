@extends('layout')

	@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                 
                </div>
            </div>
        </div>

    </div> -->

</div>

<div class="container" style="margin-top: 52px;width: 500px;height: 60%;">


    <center><h3>Sub Category Form</h3></center>
       <form id='frm'>
   <div class="form-group">
    	<label for="">Choose a Category:</label>
    

			<select class="form-control" id="cat">

    		<option value="0">Select an Option</option>
	     </select>
    </div>

    	 <input type='hidden' id="num">
    	
  <div class="form-group">
    <label for="exampleInputPassword1">Sub Category</label>
    <input type="text" class="form-control" id="sub_cat" placeholder="Enter subcategory">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Remarks</label>
    <input type="text" class="form-control" id="remarks" placeholder="Enter sub remarks">
  </div>

  <button type="submit" id="submit" class="btn btn-primary">Submit</button>
</form>
</div>
        <!-- <div id="add"></div> -->

    

    <center> <table id='table1' class="table" style='width:86%'>
        <thead>
            <th  scope="col">ID</th>
            <th  scope="col">Category</th>
             <th  scope="col">Sub Category</th>
            <th  scope="col">Remarks</th>
            <th  scope="col">Edit</th>
            <th  scope="col">Delete</th>
        </thead>
        <tbody>
            @isset($data)
            @foreach($data as $datas)
            <tr id="{{ 'r'.$datas->id }}">
                <td>{{ $datas->id }}</td>
                <td>{{ $datas->cate_name }}</td>
                <td>{{ $datas->subcate }}</td>
                <td>{{ $datas->remarks }}</td>
                <td><button class="btn btn-success" name="edit" id="{{ $datas->id }}">Edit</button></td>
                <td><button class="btn btn-danger"  id="{{ $datas->id }}">Delete</button></td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table></center>

@endsection

</body>
<script src="assets/jquery.js"></script>
<script>
	
	$(document).ready(function(){



				 var cate;
				var c ='data';

		$.post('subcatdata',{
			data:c
		},function(data,sucess,xhr){



			$.each(data,function(key,value){

					// var i=0;
			



					



				for(var i=0;i<value.length;i++)
				{

					var cate = value[i]['category'];
					var id = value[i]['id'];

						$('#cat').append($('<option>', {value:id, text:cate}));

				}





		



				} );



							
						

			
		});


		$(document).on('click','#submit',function(evente){

			event.preventDefault();

            var catee =  $("#cat option:selected").text();
            var subcatee = $("#sub_cat").val();

            if(subcatee == catee ){
                    alert('please give different name');
                     return false;
                }

			var cat_id = $("#cat option:selected").val();

			var category = $("#cat option:selected").text();

			var subcate = $('#sub_cat').val();

			var remarks = $('#remarks').val();

			$.post('subcatinsert',{

				cat_id:cat_id,
				category:category,
				subcate:subcate,
				remarks:remarks
			},function(data){

				 $.each(data,function(key,value){

                                        // $('#add').html(value[0][id="add"]);
                                    // alert(value[0]['category'])

                        var row= ''

                        var rid = value[0]["id"];




                        row +='<tr id=r'+rid+'><td>'+value[0]["id"]+'</td><td>'+value[0]["cate_name"]+'</td><td>'+value[0]["subcate"]+'</td><td>'+value[0]["remarks"]+'</tdt><td><button class="btn btn-success" name="edit" id='+rid+' >edit</button></td><td><button class="btn btn-danger" id='+value[0]["id"]+'>delete</button></td></tr>'



                                $('tbody').append(row);


                                });


                               // $('#cat').val('');12
                                $('#sub_cat').val('');

                                $('#remarks').val('');

                                 //$("#cat").val('');




                                 $( '#frm' ).each(function(){
    							this.reset();

								});
				



			});










			// var data =  $("#frm").serializeArray();

			
		});

		//update

		      $(document).on('click','.btn-success',function(event){

		      	event.preventDefault();

                   var idu =  this.id


                    // alert(idu);




                     var u = 'update'


                        $.ajax({
                        url:'subupdate',
                        type:'post',
                        data:{
                            id:idu,
                            sta:u

                        },

                        success:function(data){

                          
                               
                         



                                  $.each(data,function(key,value){

                                   

                                        $('option:contains(' + value[0]["cate_name"] + ')').attr('selected', true); 
                                          $('#sub_cat').val(value[0]['subcate']);
                                           $('#remarks').val(value[0]['remarks']);
                                            $('#num').val(value[0]['id']); 
                                            $('#cat option:selected').text(value[0]['cate_name']); 
                                           
                                         

                                });



                                   $("#submit").html('update');
                                   $('#submit').attr('id','update'); 
                                    $('#frm').attr('id','formup'); 





                                 




                                
                          

                            

                           

                        }




                    });

                    
                });

		      //updatetrue


                $(document).on('click', '#update', function(event){ 



                    event.preventDefault();

                   


                    var cate = $("#cat option:selected").text();

                    var subcate = $('#sub_cat').val();

                    var rem = $('#remarks').val();

                    var id = $("#cat option:selected").val();

                     var ido = $('#num').val();


                    // alert(cate+rem)

                    // ajax


                      $.ajax({
                        url:'subupdatetrue',
                        type:'post',
                        data:{
                        	sc:subcate,
                            c:cate,
                            r:rem,
                            ida:id,
                            idsu:ido


                        },

                        success:function(data){





                          
                               
                         



                                // console.log(data);

                               $.each(data,function(key,value){

   


                        //       console.log(value[0]['category'];
                        //          console.log(value[0]['remarks']);
                        //        console.log( value[0]['id']);


                                var txtc = value[0]['cate_name'];
                                 var txtsc = value[0]['subcate'];
                                 var txtr = value[0]['remarks'];


                        $('#r'+value[0]['id']).find("td:eq(1)").text(txtc);

                        $('#r'+value[0]['id']).find("td:eq(2)").text(txtsc);

                         $('#r'+value[0]['id']).find("td:eq(3)").text(txtr);

                                // currentRow. find("td:eq(2)")


                    // $('#table1 #r'+value[0]['id']).find("td:eq(2)").text(txt);


                            
                            
         

                         });








                                  
                    $('#sub_cat').val('');
                    $('#remarks').val('');
                    $("#update").html('submit');
                    $('#update').attr('id','submit'); 
                    $('#formup').attr('id','frm'); 
                   // $("#cat  option:eq(1)").attr('value ','selected disabled hidden');
                    //$("option:selected").removeAttr("selected");
                     //$('#cat option:selected').text('Select an Option');
                    //$('')
                     //$('#cat option:selected').val('0');
                   // $('#cat').val ('selected disabled hidden');
                  // $('#cat option:eq(0)').text('Select an Option');  
                  //$('#myDiv').load(' #myDiv')
                    // $('#cat').append($('<option></option>').val('Select cat').html('Select the option'));
                    $(" option:selected").removeAttr("selected");
                     $("#cat")[0].selectedIndex = 0;
                       


                    















                   

                                 




                                
                          

                            

                           

                        }




                    });



                    // ajax end

                   




                       
                  

                    
               
                });




		//detetion

		$(document).on('click','.btn-danger',function(){

				event.preventDefault();
						
					 var idt;

                       var idt = this.id;


                      


                      $('#r'+this.id).hide(function(){

                        //var idt = this.id;
                        var s = 'delete'


                        $.ajax({
                        url:'subdelete',
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
