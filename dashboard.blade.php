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

<div class="container" style="margin-top: 52px;width: 500px;">


    <!-- <center><h3>category form</h3></center> -->
        <form   id="form1" >
         
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="category" id="category" placeholder="Enter Category">
                </div>

            <input type='hidden' id="num">
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label" >Remarks</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="remarks"  name="remarks" placeholder="Enter  remarks">
                </div>
            </div>

            <!-- <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <label class="form-check-label">
                        <input type="checkbox">Remember me
                    </label>
                </div>
            </div> -->

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" id="submit" class="btn btn-primary" value="">Submit</button>
                </div>
            </div>
        </form>
         </div>

        <!-- <div id="add"></div> -->

   

   <center> <table id='table1' class="table" style='width:84%'>
        <thead>
            <th  scope="col">ID</th>
            <th  scope="col">Category</th>
            <th  scope="col">Remarks</th>
            <th  scope="col">Edit</th>
            <th  scope="col">Delete</th>
        </thead>
        <tbody>
            @isset($data)
            @foreach($data as $datas)
            <tr id="{{ 'r'.$datas->id }}">
                <td>{{ $datas->id }}</td>
                <td>{{ $datas->category }}</td>
                <td>{{ $datas->remarks }}</td>
                <td><button class="btn btn-success" name="edit" id="{{ $datas->id }}">Edit</button></td>
                <td><button class="btn btn-danger"  id="{{ $datas->id }}">Delete</button></td>
            </tr>
            @endforeach
            @endisset
        </tbody>
    </table></center>

@endsection
<script src="assets/jquery.js"></script>
    <script>
        $(document).ready(function(){



           


                $(document).on('click','#submit',function(event){

                       event.preventDefault();

                    

                     var cat = $('#category').val();

                     var rem = $('#remarks').val();

                      var up = $('#num').val();

                     $.ajax({

                        url:'catinsert',
                        type:'post',
                        data:{
                            category:cat,
                            remarks:rem,
                            upd:up

                        },

                        success:function(data,status,xhr){
                            

                            
                               
                                $.each(data,function(key,value){

                                        // $('#add').html(value[0][id="add"]);
                                    // alert(value[0]['category'])

                        var row= ''

                        var rid = value[0]["id"];




                        row +='<tr id=r'+rid+'><td>'+value[0]["id"]+'</td><td>'+value[0]["category"]+'</td><td>'+value[0]["remarks"]+'</tdt><td><button class="btn btn-success" name="edit" id='+rid+' >edit</button></td><td><button class="btn btn-danger" id='+value[0]["id"]+'>delete</button></td></tr>'



                                $('tbody').append(row);


                                });


                                $('#category').val('');

                                 $('#remarks').val('');

                                  $('#cat').text('');



                                 if(data == 'update_')
                                 {


                                    alert(data);
                                 }

                                




                                 



                                   
                                

                            
                        }

                     });


                    



                      // $('form').hide(function(){
                      //                    $('#category').val('');

                      //                   $('#remarks').val('');
                      //               });


                });

                // edit

                $(document).on('click','.btn-success',function(){

                   var idu =  this.id


                    // alert(idu);




                     var u = 'update'


                        $.ajax({
                        url:'update',
                        type:'post',
                        data:{
                            id:idu,
                            sta:u

                        },

                        success:function(data){

                          
                               
                         



                                  $.each(data,function(key,value){

                                   


                                          $('#category').val(value[0]['category']);
                                           $('#remarks').val(value[0]['remarks']);
                                           $('#num').val(value[0]['id']); 
                                         

                                });



                                   $("#submit").html('update');
                                   $('#submit').attr('id','update'); 
                                    $('#form1').attr('id','formup'); 



                                 




                                
                          

                            

                           

                        }




                    });

                    
                });

                 // edit end

                // update

                // $("#update").on('click','#formup',function(){


                //     alert('test');

                   
                         


                // });

                $(document).on('click', '#update', function(){ 

                    event.preventDefault();


                    var cate = $('#category').val();

                    var rem = $('#remarks').val();

                    var id = $('#num').val();


                    // alert(cate+rem)

                    // ajax


                      $.ajax({
                        url:'updatetrue',
                        type:'post',
                        data:{
                            c:cate,
                            r:rem,
                            ida:id

                        },

                        success:function(data){





                          
                               
                         



                                // console.log(data);

                               $.each(data,function(key,value){

   


                        //       console.log(value[0]['category'];
                        //          console.log(value[0]['remarks']);
                        //        console.log( value[0]['id']);


                                var txt = value[0]['category'];
                                 var txtr = value[0]['remarks'];


                        $('#r'+value[0]['id']).find("td:eq(1)").text(txt);

                        $('#r'+value[0]['id']).find("td:eq(2)").text(txtr);

                                // currentRow. find("td:eq(2)")


                    // $('#table1 #r'+value[0]['id']).find("td:eq(2)").text(txt);


                            alert('Category Updated')
                            
         

                         });






                                  
                    $('#category').val('');
                    $('#remarks').val('');
                    $("#update").html('submit');
                    $('#update').attr('id','submit'); 
                    $('#formup').attr('id','form1'); 

                                 




                                
                          

                            

                           

                        }




                    });



                    // ajax end

                   




                       
                

                    
               
                });

                // update end

                 $(document).on('click','.btn-danger',function(){

                    var idt;

                       var idt = this.id;


                      


                      $('#r'+this.id).hide(function(){

                        //var idt = this.id;
                        var s = 'delete'


                        $.ajax({
                        url:'delete',
                        type:'post',
                        data:{
                            id:idt,
                            sta:s

                        },

                        success:function(data){

                           if(data=='submit')
                           {
                            //
                           }
                           else if(data){

                              alert('Category Deleted')
                           }
                           else if(data==0){

                            alert('data not deleted')
                           }
                        
                          

                            

                           

                        }




                    });

                        // ajax end


                      });


                       
                       
               
                                          
                     });



                





                 








                
               
            
        });


    </script>


