@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover mb-5 datatable datatable-Meal ui-sortable" >
        <thead class="ui-sortable-handle">
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Sort Id</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody class="sortable ui-sortable-handle ui-sortable">
            @foreach($links as $data)
            <tr class="meal ui-sortable-handle" data-id="{{ $data->id }}">
                <th scope="row">{{ $data->id }}</th>
                <td class="position">{{ $data->sort_id }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->URL }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{-- Pagination --}}
      <div class="d-flex justify-content-center">
        {{ $links->links() }}
      </div>
    </div>
  </div>
      
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="http://127.0.0.1:8001/js/main.js"></script>
<script>
$(function() {
let copyButtonTrans = 'Copy'
let csvButtonTrans = 'CSV'
let excelButtonTrans = 'Excel'
let pdfButtonTrans = 'PDF'
let printButtonTrans = 'Print'
let colvisButtonTrans = 'Column visibility'
let selectAllButtonTrans = 'Select all'
let selectNoneButtonTrans = 'Deselect all'

let languages = {
'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
};

$.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
$.extend(true, $.fn.dataTable.defaults, {
language: {
url: languages['en']
},
columnDefs: [{
orderable: false,
className: 'select-checkbox',
targets: 0
}, {
orderable: false,
searchable: false,
targets: -1
}],
select: {
style:    'multi+shift',
selector: 'td:first-child'
},
order: [],
scrollX: true,
pageLength: 100,
dom: 'lBfrtip<"actions">',
buttons: [
{
className: 'btn-primary',
text: selectAllButtonTrans,
exportOptions: {
columns: ':visible'
},
action: function (e, table) {
table.rows({ search: 'applied', page: 'current' }).select()
}
},
{
extend: 'selectNone',
className: 'btn-primary',
text: selectNoneButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'copy',
className: 'btn-default',
text: copyButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'csv',
className: 'btn-default',
text: csvButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'excel',
className: 'btn-default',
text: excelButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'pdf',
className: 'btn-default',
text: pdfButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'print',
className: 'btn-default',
text: printButtonTrans,
exportOptions: {
columns: ':visible'
}
},
{
extend: 'colvis',
className: 'btn-default',
text: colvisButtonTrans,
exportOptions: {
columns: ':visible'
}
}
]
});

$.fn.dataTable.ext.classes.sPageButton = '';
});

</script>

<script>
function sendReorderMealsRequest($category) {
var items = $category.sortable('toArray', {attribute: 'data-id'});
var ids = $.grep(items, (item) => item !== "");

if ($category.find('tr.meal').length) {
$category.find('.empty-message').hide();
}
$category.find('.category-name').text($category.find('tr:first td').text());

$.post('http://127.0.0.1:8001/admin/meals/reorder', {
  _token,
  ids,
  category_id: $category.data('id')
})
.done(function (response) {
  $category.children('tr.meal').each(function (index, meal) {
      $(meal).children('.position').text(response.positions[$(meal).data('id')])
  });
})
.fail(function (response) {
  alert('Error occured while sending reorder request');
  location.reload();
});
}

$(document).ready(function () {
var $categories = $('table');
var $meals = $('.sortable');

$categories.sortable({
cancel: 'thead',
stop: () => {
  var items = $categories.sortable('toArray', {attribute: 'data-id'});
  var ids = $.grep(items, (item) => item !== "");
  $.post('http://127.0.0.1:8001/admin/categories/reorder', {
          _token,
          ids
      })
      .fail(function (response) {
          alert('Error occured while sending reorder request');
          location.reload();
      });
}
});

$meals.sortable({
connectWith: '.sortable',
items: 'tr.meal',
stop: (event, ui) => {
  sendReorderMealsRequest($(ui.item).parent());

  if ($(event.target).data('id') != $(ui.item).parent().data('id')) {
      if ($(event.target).find('tr.meal').length) {
          sendReorderMealsRequest($(event.target));
      } else {
          $(event.target).find('.empty-message').show();
      }
  }
}
});
$('table, .sortable').disableSelection();
});
</script>
    
@endsection
