@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="table-responsive">
      <table id="table" class="table table-striped table-bordered table-hover mb-5">
        <thead>
            <tr>
              <th scope="col">Icon</th>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Description</th>
              <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody class="tablecontents" category="open">
          @foreach($tasks as $data)
            @if($data->category != "tablecontents-done" && $data->category != "tablecontents-bug" && $data->category != "tablecontents-qa" && $data->category != "tablecontents-progress") 
              <tr class="rowRef" category="open" data-id="{{ $data->id }}" >
                <td class="icon"></td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
              </tr>
            @endif
            
          @endforeach
            
        </tbody>

        <tbody id="tablecontents-done" class="tablecontents" category="done">
          <tr>
            
              <td colspan="8" class="done status" >  <span style="color:white;">Done</span>  </td>
              
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "done" )
                <tr class="rowRef" category="done" data-id="{{ $data->id }}" >
                    <td class="icon"><i class="fas fa-check"></i></td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-bug" class="tablecontents" category="bug">
          <tr>
            <td colspan="8" class="bug status"> <span style="color:white;">Bug</span> </td>
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "bug" )
                <tr class="rowRef" category="bug" data-id="{{ $data->id }}" >
                  <td class="icon"> <i class="fas fa-times"></i> </td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody id="tablecontents-qa" class="tablecontents" category="qa">
          <tr>
            <td colspan="8" class="qa background status">QA</td>
          </tr>
          @foreach($tasks as $data)
            @if ($data->category == "qa" )
              <tr class="rowRef" category="qa" data-id="{{ $data->id }}" >
                <td class="icon"><i class="fab fa-searchengin text-info"></i></td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
              </tr>
            @endif
          @endforeach
      </tbody>

        <tbody id="tablecontents-progress" class="tablecontents" category="progress">
            <tr>
              <td colspan="8" class="in-progress background status"> <span style="color:white;"> Progress </span> </td>
            </tr>
            @foreach($tasks as $data)
              @if ($data->category == "progress" )
                <tr class="rowRef" category="progress" data-id="{{ $data->id }}" >
                  <td class="icon"><i class="fas fa-wrench text-warning"></i></td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->category }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
      
</div>



<script>
$(document).ready(function () {

  var droppedInto;

  $("#table").dataTable({
    "order": []
  });

  $( ".tablecontents" ).sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function() {
      
        //updatePosition();
        
        

    }
    
  });


  function droppedAfter(){
    
    if(event.target.tagName == 'TD' && event.target.closest('tr').className.includes('rowRef')){
        
      var data_id = event.target.closest('tr').getAttribute('data-id');
      var fromCategory = event.target.closest('tr').closest('tbody').getAttribute('category');
      var Vcategory = event.target.closest('tr').getAttribute('category');
        
       
      
       if(data_id == 'undefined'){
         alert('undefined');
       }

        console.log( 'From Category-' + fromCategory + ', Droped Into-' + droppedInto + ', data-id-' +data_id);
        
        if( fromCategory != droppedInto && data_id !== null && droppedInto !== null ){
          var keepHtml = $('.rowRef[data-id="'+ data_id +'"]').html();
          console.log(' Deleted '+ keepHtml);
          $('.rowRef[data-id="'+ data_id +'"]').remove();
          console.log('this is data-id '+data_id);

           
          
          $('<tr class="rowRef" category="'+droppedInto+'" data-id="'+data_id+'">'+keepHtml+'</tr>').appendTo('#table .tablecontents[category="'+ droppedInto +'"]');

          $('#tablecontents-done .rowRef .icon').html('<i class="fas fa-check"></i>');
          $('#tablecontents-bug .rowRef .icon').html('<i class="fas fa-times"></i>');
          $('#tablecontents-qa .rowRef .icon').html('<i class="fab fa-searchengin text-info"></i>');
          $('#tablecontents-progress .rowRef .icon').html('<i class="fas fa-wrench text-warning"></i>');


          //fr
          
          var order = [];
          $('tr.rowRef').each(function(index,element) {
            if(element.getAttribute('data-id') != null){
              order.push({
                id: element.getAttribute('data-id'),
                sort_id: index+1
              });
            }
          });

          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('sprint/sortabledatatable') }}",
            data: {
              order:order,
              data_id: data_id,
              category: droppedInto,
              _token: '{{csrf_token()}}'
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });

          

          

          data_id = null;
          droppedInto = null;
          
          
        }
        
      }
  }

  $( ".tablecontents" ).droppable({
    drop: function( event, ui ) {
      droppedInto = this.getAttribute('category');
      alert(droppedInto);
      droppedAfter();
      //updatePosition();
      //populateTable();
    }
  });

function updatePosition() {

  var order = [];
  $('tr.rowRef').each(function(index,element) {
    
    //if(this.parentNode.id != ''){
      console.log( $(this).attr('data-id') );
      order.push({
        id: $(this).attr('data-id'),
        sort_id: index+1
      });
    //}

    
    
  });

  // /alert(order);

 

  $.ajax({
    type: "POST", 
    dataType: "json", 
    url: "{{ url('sprint/sortabledatatable') }}",
    data: {
      order:order,
      _token: '{{csrf_token()}}'
    },
    success: function(response) {
        if (response.status == "success") {
          console.log(response);
        } else {
          console.log(response);
        }
    }
  });

  

}


function populateTable(){
  $.getJSON("{{ url('sprint/populate') }}", function (data) {
    json_obj = data;

    /*
    $("#table #tablecontents-bug .rowRef").remove();
    $("#table #tablecontents-qa .rowRef").remove();
    $("#table #tablecontents-progress .rowRef").remove();
    $("#table #tablecontents-done .rowRef").remove();
    */

  
    $('tr.rowRef').each(function(index,element) {
      
      
  
      order.push({
        id: $(this).attr('data-id'),
        sort_id: index+1
      });
    

      
      
    });


    data.forEach((item) => {


     // if ($("#mydiv").length){  }


      if( item.category ==  "tablecontents-done" ) {

          
        $('<tr class="rowRef" data-id="'+item.id+'">'+
          '<td> <i class="fas fa-check"></i>  '+item.title+'</td>'+
          '<td>'+item.category+'</td>'+
          '<td>'+item.description+'</td>'+
          '<td>'+item.url+'</td>'+
        '</tr>').appendTo("#table #"+item.category);

      }else if( item.category ==  "tablecontents-bug" ) {
        $('<tr class="rowRef" data-id="'+item.id+'">'+
          '<td> <i class="fas fa-times"></i> '+item.title+'</td>'+
          '<td>'+item.category+'</td>'+
          '<td>'+item.description+'</td>'+
          '<td>'+item.url+'</td>'+
        '</tr>').appendTo("#table #"+item.category);

      }else if( item.category ==  "tablecontents-qa" ) {
        $('<tr class="rowRef" data-id="'+item.id+'">'+
          '<td> <i class="fab fa-searchengin text-info"></i> '+item.title+'</td>'+
          '<td>'+item.category+'</td>'+
          '<td>'+item.description+'</td>'+
          '<td>'+item.url+'</td>'+
        '</tr>').appendTo("#table #"+item.category);

      }else if( item.category ==  "tablecontents-progress" ) {
        $('<tr class="rowRef" data-id="'+item.id+'">'+
          '<td> <i class="fas fa-wrench text-warning"></i> '+item.title+'</td>'+
          '<td>'+item.category+'</td>'+
          '<td>'+item.description+'</td>'+
          '<td>'+item.url+'</td>'+
        '</tr>').appendTo("#table #"+item.category);

      }

      
      
      








    });
  });
}

});
</script>
    
@endsection
