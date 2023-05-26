<table id="myTable">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <tr>
    <td>John Doe</td>
    <td>johndoe@example.com</td>
    <td><button onclick="editRow(this)">Edit</button></td>
  </tr>
  <tr>
    <td>Jane Smith</td>
    <td>janesmith@example.com</td>
    <td><button onclick="editRow(this)">Edit</button></td>
  </tr>
  <!-- More rows... -->
</table>

<script>
function editRow(button) {
  // Get the row element
  var row = button.parentNode.parentNode;

  // Get the cell values within the row
  var name = row.cells[0].innerHTML;
  var email = row.cells[1].innerHTML;


}
</script>
