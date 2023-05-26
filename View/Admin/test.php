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
  let table = document.getElementById("myTable");

  var inputs = container.querySelectorAll('input');

  inputs.forEach(function(input) {
      input.readOnly = false;
    });
    


}
</script>
