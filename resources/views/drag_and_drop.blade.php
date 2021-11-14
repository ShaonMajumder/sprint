<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
  
<style>
  table#example.dataTable tbody tr.over {
  background-color: #ffa;
}

table#example.dataTable tbody tr.over > .sorting_1 {
  background-color: #ffa;
}

table#example2.dataTable tbody tr.over {
  background-color: #ffa;
}

table#example2.dataTable tbody tr.over > .sorting_1 {
  background-color: #ffa;
}





</style>

<script>
  $(document).ready( function () {
  var dragSrcRow = null;  // Keep track of the source row
  var srcTable = '';  // Global tracking of table being dragged for 'over' class setting
  var rows = [];   // Global rows for #example
  var rows2 = [];  // Global rows for #example2
  
  var data =  [
    [
      "Tiger Nixon",
      "System Architect",
      "Edinburgh",
      "5421",
      "2011/04/25",
      "$320,800"
    ],
    [
      "Garrett Winters",
      "Accountant",
      "Tokyo",
      "8422",
      "2011/07/25",
      "$170,750"
    ],
    [
      "Ashton Cox",
      "Junior Technical Author",
      "San Francisco",
      "1562",
      "2009/01/12",
      "$86,000"
    ],
    [
      "Cedric Kelly",
      "Senior Javascript Developer",
      "Edinburgh",
      "6224",
      "2012/03/29",
      "$433,060"
    ],
];
  
var data2 = [
      [
      "Rhona Davidson",
      "Integration Specialist",
      "Tokyo",
      "6200",
      "2010/10/14",
      "$327,900"
    ],
    [
      "Colleen Hurst",
      "Javascript Developer",
      "San Francisco",
      "2360",
      "2009/09/15",
      "$205,500"
    ],
    [
      "Sonya Frost",
      "Software Engineer",
      "Edinburgh",
      "1667",
      "2008/12/13",
      "$103,600"
    ],
    [
      "Jena Gaines",
      "Office Manager",
      "London",
      "3814",
      "2008/12/19",
      "$90,560"
    ],
]
  
  var table = $('#example').DataTable({
    data: data,
    paging: false,
    
    // Add HTML5 draggable class to each row
    createdRow: function ( row, data, dataIndex, cells ) {
      $(row).attr('draggable', 'true');
      $( "#example tbody" ).attr('sortable', 'true');
    },
    
    
    drawCallback: function () {
      // Add HTML5 draggable event listeners to each row
      rows = document.querySelectorAll('#example tbody tr');
        [].forEach.call(rows, function(row) {
          row.addEventListener('dragstart', handleDragStart, false);
          row.addEventListener('dragenter', handleDragEnter, false)
          row.addEventListener('dragover', handleDragOver, false);
          row.addEventListener('dragleave', handleDragLeave, false);
          row.addEventListener('drop', handleDrop, false);
          row.addEventListener('dragend', handleDragEnd, false);
        });
    }
  });

    
 

  
  var table2 = $('#example2').DataTable({
    data: data2,
    paging: false,
    
    // Add HTML5 draggable class to each row
    createdRow: function ( row, data, dataIndex, cells ) {
      $(row).attr('draggable', 'true');
    },

    drawCallback: function () {
      // Add HTML5 draggable event listeners to each row
      rows2 = document.querySelectorAll('#example2 tbody tr');
        [].forEach.call(rows2, function(row) {
          row.addEventListener('dragstart', handleDragStart, false);
          row.addEventListener('dragenter', handleDragEnter, false)
          row.addEventListener('dragover', handleDragOver, false);
          row.addEventListener('dragleave', handleDragLeave, false);
          row.addEventListener('drop', handleDrop, false);
          row.addEventListener('dragend', handleDragEnd, false);
        });
    }  
  });
  
function handleDragStart(e) {
  // this / e.target is the source node.
  
  // Set the source row opacity
  this.style.opacity = '0.4';
  
  // Keep track globally of the source row and source table id
  dragSrcRow = this;
  srcTable = this.parentNode.parentNode.id

  // Allow moves
  e.dataTransfer.effectAllowed = 'move';
  
  // Save the source row html as text
  e.dataTransfer.setData('text/plain', e.target.outerHTML);
  
}
  
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  // Allow moves
  e.dataTransfer.dropEffect = 'move'; 

  return false;
}

function handleDragEnter(e) {
  // this / e.target is the current hover target.  
  
  // Get current table id
  var currentTable = this.parentNode.parentNode.id
  
  // Don't show drop zone if in source table
  if (currentTable !== srcTable) {
    this.classList.add('over');
  }
}

function handleDragLeave(e) {
  // this / e.target is previous target element.
  
  // Remove the drop zone when leaving element
  this.classList.remove('over');  
}
  
function handleDrop(e) {
  // this / e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // stops the browser from redirecting.
  }

  // Get destination table id, row
  var dstTable = $(this.closest('table')).attr('id');
  var dstRow = $(this).closest('tr');

  // No need to process if src and dst table are the same
  if (srcTable !== dstTable) {
  
    // Get source transfer data
    var srcData = e.dataTransfer.getData('text/plain');

    // Add row to destination Datatable
    $('#' + dstTable).DataTable().row.add($(srcData)).draw();

    // Remove ro from source Datatable
    $('#' + srcTable).DataTable().row(dragSrcRow).remove().draw();

  }
  return false;
}

function handleDragEnd(e) {
  // this/e.target is the source node.
  
  // Reset the opacity of the source row
  this.style.opacity = '1.0';

  // Clear 'over' class from both tables
  // and reset opacity
  [].forEach.call(rows, function (row) {
    row.classList.remove('over');
    row.style.opacity = '1.0';
  });

  [].forEach.call(rows2, function (row) {
    row.classList.remove('over');
    row.style.opacity = '1.0';
  });
}



} );
</script>
</head>
<body>

    <div class="container">
      <table id="example" class="tablegrid display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr>
        </tfoot>

      </table>

      <table id="example2" class="tablegrid display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr>
        </tfoot>

      </table>

</body>
</html>