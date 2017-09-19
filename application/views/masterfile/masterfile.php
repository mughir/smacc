<div id="createcostcenter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Cost Center</h4>
      </div>
	  <form method="post" action="http://anggaran.ska.web.id/home/input">
		<div class="modal-body">
		<table class="form">
		  <tr><td>ID : </td><td><input required type="text" name="id"></td></tr>
		  <tr><td>Description : </td><td><input required type="text" name="description"></td></tr>
		 </table>
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>



 <div class="well ">
<h3>Maintain cost center</h3>
<p>Fitur ini digunakan untuk mengelola data unit cost-center yang ada di sistem.
</div>
</div>

<div class="afix" data-spy="affix" data-offset-top="186">
 <div class="container">
<div class="row">
<div class="col-sm-3 col-xs-3">
<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createcostcenter">+ Create New Cost Center</button>
</div>
</div>
</div>
</div>




<br>

<div class="container">
<table class='table' id="ajaxtable">
<thead>
<tr><th>ID</th><th>Description</th></tr>
</thead>
<tbody>
<tr><td>12011014</td><td>Anggaran Riset 1</td></tr>
</tbody>
</table>