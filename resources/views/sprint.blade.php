@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="table-responsive-md">
      
      <button type="button" class="icon-button qa" data-target="#createTaskModal" data-toggle="modal"> <i class="fas fa-plus"></i> Add Task</button>
      <button type="button" class="icon-button qa" data-target="#createCategoryModal" data-toggle="modal"> <i class="fas fa-plus"></i> Add Category</button>
      @include('layouts.create-task-popup')
      @include('layouts.create-category-popup')
      
      <table id="table" class="table table-striped table-bordered table-hover mb-5">
        <thead>
            <tr>
              <th scope="col">Icon</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">URL</th>
            </tr>
            <tr>
              <td colspan="8" class="open status" >  <span style="color:white;">open</span>  </td>
            </tr>
        </thead>
        
        <tbody class="tablecontents" dropped-into-category="open">
          
          
          @foreach($tasks as $data)
            @if($data->category == "open") 
              <tr class="rowRef" category="open" data-id="{{ $data->id }}" >
                <td class="icon"></td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->url }}</td>
              </tr>
            @endif
            
          @endforeach
            
        </tbody>

        <tbody class="tablecontents" dropped-into-category="done">
          <tr>
              <td colspan="8" class="done status" >  <span style="color:white;">Done</span>  </td>
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "done" )
                <tr class="rowRef" category="done" data-id="{{ $data->id }}" >
                    <td class="icon"><i class="fas fa-check"></i></td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody class="tablecontents" dropped-into-category="bug">
          <tr>
            <td colspan="8" class="bug status"> <span style="color:white;">Bug</span> </td>
          </tr>
            @foreach($tasks as $data)
              @if ($data->category == "bug" )
                <tr class="rowRef" category="bug" data-id="{{ $data->id }}" >
                  <td class="icon"> <i class="fas fa-times"></i> </td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
                </tr>
              @endif
            @endforeach
        </tbody>

        <tbody class="tablecontents" dropped-into-category="qa">
          <tr>
            <td colspan="8" class="qa background status">QA</td>
          </tr>
          @foreach($tasks as $data)
            @if ($data->category == "qa" )
              <tr class="rowRef" category="qa" data-id="{{ $data->id }}" >
                <td class="icon"><i class="fab fa-searchengin text-info"></i></td>
                  <td>{{ $data->title }}</td>
                  <td>{{ $data->description }}</td>
                  <td>{{ $data->url }}</td>
              </tr>
            @endif
          @endforeach
      </tbody>

        <tbody class="tablecontents" dropped-into-category="progress">
            <tr>
              <td colspan="8" class="progress background status"> <span style="color:white;"> Progress </span> </td>
            </tr>
            @foreach($tasks as $data)
              @if ($data->category == "progress" )
                <tr class="rowRef" category="progress" data-id="{{ $data->id }}" >
                  <td class="icon"><i class="fas fa-wrench text-warning"></i></td>
                  <td>{{ $data->title }}</td>
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
    
@endsection

@section('top-head-css')
    <style>
    @foreach($categories as $catogory)
        .{{ $catogory->name }} {
        background-color: {{$catogory->color}};
        }
    @endforeach

    </style>
@endsection


@section('top-head-js')
<script>

  var categories = {
    value: '',
    letMeKnow() {
      console.log(`The variable has changed to ${this.testVar}`);
      updateIcons();
    },
    get testVar() {
      return this.value;
    },
    set testVar(value) {
      this.value = value;
      this.letMeKnow();
    }
  }
  categories.testVar = null;

  function updateIcons(){
    if( categories.testVar != null ){
      categories.testVar.forEach(element => {
        $('.rowRef[category="'+ element.name +'"] .icon').html(element.icon);  
      });
    } 
  }

  function getCategories(){
    $.ajax({
      url: "{{ route('getCategories') }}",
      type: 'POST',
      data: {
        "_token": "{{ csrf_token() }}"
      },
      datatype: 'json',
      success: function (data) { 
        categories.testVar = data;    
      },
      error: function (jqXHR, textStatus, errorThrown) { 
          
      }
    });
  }

$(document).ready(function () {  
 
  


  
  getCategories();
   
    
  

  
  
  function insertRow(data){
        
    $('<tr class="rowRef ui-sortable-handle" category="'+data.category+'" data-id="'+data.id+'">'+
        '<td class="icon"></td>'+
        '<td>'+data.title+'</td>'+
        '<td>'+data.description+'</td>'+
        '<td>'+data.url+'</td>'+
    '</tr>').appendTo('#table .tablecontents[dropped-into-category="'+ data.category +'"]');
    
    updatePosition();
    updateIcons();
  }
  



  function addCategory(){
    const form = document.querySelector('#newCategoryForm');
    const data = Object.fromEntries(new FormData(form).entries());
    
    
    $.ajax({
        url: "{{ route('new_category') }}",
        type: 'POST',
        data: data,
        datatype: 'json',
        success: function (data) { 
            insertRow(data);
        },
        error: function (jqXHR, textStatus, errorThrown) { 
            
        }
    });

    $('#createTaskModal').modal('hide');
    $("#newtaskForm").trigger("reset");

    
    data_id = null;
  }

  function addtask(){
    const form = document.querySelector('#newtaskForm');
    const data = Object.fromEntries(new FormData(form).entries());
    data["category"] = "open";
>>>>>>> 15934c2c1761062ec866453fc27e301f6964fc6f
    
    function addtask(){
      const form = document.querySelector('#newtaskForm');
      const data = Object.fromEntries(new FormData(form).entries());
      data["category"] = "open";
      
      $.ajax({
          url: "{{ route('new_task') }}",
          type: 'POST',
          data: data,
          datatype: 'json',
          success: function (data) { 
              console.log(data); 
              insertRow(data);
          },
          error: function (jqXHR, textStatus, errorThrown) { 
              
          }
      });

      $('#createTaskModal').modal('hide');
      $("#newtaskForm").trigger("reset");

      
      data_id = null;
    }

    function updatePosition(){
      var order = [];
      $('tr.rowRef').each(function(index,element) {
        if(element.getAttribute('data-id') != null){
          order.push({
            id: element.getAttribute('data-id'),
            category: element.getAttribute('category'),
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
    
    

<<<<<<< HEAD
    
=======
  
  
        

>>>>>>> 15934c2c1761062ec866453fc27e301f6964fc6f

    $("#table").dataTable({
      "order": []
    });

    $( ".tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
        updatePosition();
      }
    });


    function droppedAfter(){
      
      if(event.target.tagName == 'TD' && event.target.closest('tr').className.includes('rowRef')){
          
        var data_id = event.target.closest('tr').getAttribute('data-id');
        var fromCategory = event.target.closest('tbody').getAttribute('dropped-into-category');
        
        // if error occurs for debugging
        if(data_id == 'undefined'){
          console.log('undefined data_id');
        }
          
        if( fromCategory != droppedIntoCategory && ( data_id !== null && droppedIntoCategory !== null ) ){
          
          var keepHtml = $('.rowRef[data-id="'+ data_id +'"]').html();
          $('.rowRef[data-id="'+ data_id +'"]').remove();
          $('<tr class="rowRef" category="'+droppedIntoCategory+'" data-id="'+data_id+'">'+
              keepHtml+
            '</tr>').appendTo('#table .tablecontents[dropped-into-category="'+ droppedIntoCategory +'"]');
          updateIcons();
          updatePosition();
          data_id = null;
          droppedInto = null;
        }
          
      }
    }

    $( ".tablecontents" ).droppable({
      drop: function( event, ui ) {
        droppedIntoCategory = this.getAttribute('dropped-into-category');
        droppedAfter(droppedIntoCategory);
      }
    });


    updateIcons();
    $( "#btnNewTaskForm" ).click(function() {
      addtask();
    });

  });
</script>
@endsection