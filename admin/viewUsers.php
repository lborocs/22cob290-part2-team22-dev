<script src="admin/viewUsers.js"></script>
<div class = "table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Email</th>
                <th scope="col">Amount of Tasks Assigned</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body">
        <table class="table table-hover" id="modalTable">
            <thead>
                <tr>
                    <th scope="col">Project Name</th>
                    <th scope="col">Amount of Tasks Assigned</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody id="modalTableBody">
            </tbody>
        </table>
        <h6 id="noProjects">This User is Not Assigned to any Projects</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>