<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
      Add Todo List
    </button> <br><br>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Todo List</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
              <form action="../todo/save_todo" class="form-horizontal" method="POST">
                <div class="box-body">
                  <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="due_date" class="col-sm-2 control-label">Due Date</label>
                    <div class="col-sm-10">
                      <input class="form-control pull-right" id="due_date" name="due_date" data-date-format="yyyy-mm-dd" placeholder="Due Date">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="priority" class="col-sm-2 control-label">Priority</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="priority">
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add todo list</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Todo List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="todo_list" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $numm=1;
                      foreach($data as $key => $value){
                        echo"<tr>";
                        echo"<td>".$numm++."</td>";
                        echo"<td>".$data[$key]->description."</td>";
                        echo"<td>".$data[$key]->due_date."</td>";
                        echo"";
                        if($data[$key]->status == 1){
                            echo"<td><span class=''>DONE</span></td>";
                        }else{
                          if($data[$key]->priority == 1){
                            echo"<td><span class='label label-info'>LOW</span></td>";
                          }else if($data[$key]->priority == 2){
                            echo"<td><span class='label label-warning'>MEDIUM</span></td>";
                          }else{
                            echo"<td><b><span class='label label-danger'>HIGH</font></span></td>";
                          }
                        }
                        echo"<td>";
                        echo "<div class='btn-group'>";
                        if($data[$key]->status == 1){
                            echo"<a href='../todo/deleteTodo?todo_id=".$data[$key]->todo_id."'><button type='button' class='btn btn-danger'>Delete</button></a>
                              </div>";
                        }else{
                            echo"<a href='../todo/updateDone?todo_id=".$data[$key]->todo_id."'>";
                            echo"<button type='button' class='btn btn-warning'>Done</button></a>";
                            echo"<a href='../todo/deleteTodo?todo_id=".$data[$key]->todo_id."'><button type='button' class='btn btn-danger'>Delete</button></a>
                              </div>";
                            }
                        echo"</td>";
                        echo "</tr>";
                      }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->