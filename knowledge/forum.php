<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<div class = 'flex-master'>
<section class="jumbotron jumbotron-fluid col full-height" style = 'margin-top: 0px;'>
  <div id="Options">
      <h5 style="padding-top:27px;">Options</h5>
      <hr class="my-4">
      <div class="forumSearch">
          <input type="text" placeholder='Search...' style = 'width :99%'/>
      </div>
      <label for="memberName" style = 'text-align: left;'>Filter Tags:</label>
      <br>
      <select class="forumSearch" style = 'width :100%'>
          <option value = "None">None</option>
      </select>
      <label for="memberName" style = 'text-align: left;'>Post Age:</label>
      <br>
      <input type="range" class="form-range" id="customRange1">
      <h6>0 days</h6>
      <button type="button" class="btn btn-primary" style = 'margin-top: 100%;'>Add New Post</button>
  </div>
</section>
<table class="table table-bordered" style = 'border:1px solid black; width: 75%; margin-right: 3%; overflow-y:scroll; height: 600px; display:block;'>
    <thead class="thead-dark">
      <tr class="bg-secondary text-white">
        <th scope="col" class="col-md-5">Topic</th>
        <th scope="col">Last Post</th>
        <th scope="col">Started By</th>
        <th scope="col">Tags</th>
      </tr>
    </thead>
    <tbody>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-primary">Non-Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-danger">Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-primary">Non-Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-danger">Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-primary">Non-Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-danger">Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-primary">Non-Technical</span></td>
      </tr>
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-danger">Technical</span></td>
      </tr>
    </tbody>
  </table>
</div>
<!--Bootstrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<!--Bootstrap-->
</html>