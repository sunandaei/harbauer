<!-- resources/views/pages/home.blade.php -->
@extends('layouts.app')
@section('title', 'Home')
@section('content-header')
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Simple Tables</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
         </div>
      </div>
   </div>
</section>
@endsection
@section('content')
<div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">


                <div class="row">
                  <div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                  <thead>
                  <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th></tr>
                  </thead>
                  <tbody>
                    <tr class="odd">
                       <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                       <td class="">Mozilla 1.0</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1</td>
                       <td class="">A</td>
                     </tr><tr class="even">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.1</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.1</td>
                       <td class="">A</td>
                     </tr><tr class="odd">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.2</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.2</td>
                       <td class="">A</td>
                     </tr><tr class="even">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.3</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.3</td>
                       <td class="">A</td>
                     </tr><tr class="odd">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.4</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.4</td>
                       <td class="">A</td>
                     </tr><tr class="even">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.5</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.5</td>
                       <td class="">A</td>
                     </tr><tr class="odd">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.6</td>
                       <td class="">Win 95+ / OSX.1+</td>
                       <td class="">1.6</td>
                       <td class="">A</td>
                     </tr><tr class="even">
                       <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                       <td class="">Netscape 7.2</td>
                       <td class="">Win 95+ / Mac OS 8.6-9.2</td>
                       <td class="">1.7</td>
                       <td class="">A</td>
                     </tr><tr class="odd">
                       <td class="sorting_1 dtr-control">Gecko</td>
                       <td class="">Mozilla 1.7</td>
                       <td class="">Win 98+ / OSX.1+</td>
                       <td class="">1.7</td>
                       <td class="">A</td>
                     </tr><tr class="even">
                       <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                       <td class="">Firefox 1.0</td>
                       <td class="">Win 98+ / OSX.2+</td>
                       <td class="">1.7</td>
                       <td class="">A</td>
                     </tr>
                  </tbody>
                  <tfoot>
                  <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                  </tfoot>
                </table>
             </div>
          </div>




             </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

@endsection