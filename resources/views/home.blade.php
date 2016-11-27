@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Raw Material</div>

                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-4 col-sm-4">Name</th>
                                        <th class="col-md-3 col-sm-3">Amount</th>
                                        <th class="col-md-3 col-sm-3">Threshold</th>
                                        <th class="col-md-1 col-sm-1"></th>
                                        <th class="col-md-1 col-sm-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rawmaterials as $rawmaterial)
                                        <tr>
                                            <td class="col-md-4 col-sm-4">{{$rawmaterial->material_name}}</td>

                                            <td class="col-md-3 col-sm-3">{{$rawmaterial->amount}} {{$rawmaterial->unit}}</td>

                                            <td class="col-md-3 col-sm-3">
                                                @if ($rawmaterial->threshold)
                                                    {{$rawmaterial->threshold}} {{$rawmaterial->unit}}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="col-md-1 col-sm-1">
                                                <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#editRawMaterialModal" onclick=
                                                @if (isset($rawmaterial->threshold))
                                                    "showEditFormA({{$rawmaterial->id}}, '{{$rawmaterial->material_name}}', {{$rawmaterial->amount}}, '{{$rawmaterial->unit}}', {{$rawmaterial->threshold}})"
                                                @else
                                                    "showEditFormB({{$rawmaterial->id}}, '{{$rawmaterial->material_name}}', {{$rawmaterial->amount}}, '{{$rawmaterial->unit}}')"
                                                @endif
                                                >
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </button>
                                            </td>

                                            <td class="col-md-1 col-sm-1">
                                                <form name="delete" action="{{ url('/home') }}" method="post">
                                                {{ csrf_field() }}

                                                    <input type="hidden" name="_method" value="delete" />
                                                    <input name="delete_id" id="delete_id" type="hidden" value="{{$rawmaterial->id}}"></input>
                                                    <button type="submit" class="btn btn-default">
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-primary pull-right" onclick="resetForm()" data-toggle="modal" data-target="#addRawMaterialModal">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addRawMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addModalLabel">Add Raw Material</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="addRawMaterialForm" method="POST" action="{{ url('/home') }}"> 
            {{ csrf_field() }}
            <div class="form-group form-inline text-center">
                <input name="add_name" id="add_name" class="form-control" type="text" placeholder="Raw Material Name" required></input>

                <input name="add_amount" id="add_amount" class="form-control" type="number" min="1" placeholder="Amount" required></input>

                <input name="add_unit" id="add_unit" class="form-control" type="text" min="1" placeholder="Unit" required></input>

                <input name="add_threshold" id="add_threshold" class="form-control" type="number" min="1" placeholder="Threshold (optional)"></input>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="addRawMaterialForm">Add</button>
      </div>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editRawMaterialModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel">Edit Raw Material</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="editRawMaterialForm" method="POST" action="{{ url('/home') }}"> 
            <input type="hidden" name="_method" value="put" />
            {{ csrf_field() }}

            <input name="put_id" id="put_id" type="hidden"></input>
            <div class="form-group form-inline text-center">
                <input name="put_name" id="put_name" class="form-control" type="text" placeholder="Raw Material Name" required></input>

                <input name="put_amount" id="put_amount" class="form-control" type="number" min="1" placeholder="Amount" required></input>

                <input name="put_unit" id="put_unit" class="form-control" type="text" min="1" placeholder="Unit" required></input>

                <input name="put_threshold" id="put_threshold" class="form-control" type="number" min="1" placeholder="Threshold (optional)"></input>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="editRawMaterialForm">Add</button>
      </div>
    </div>
  </div>
</div>

<script>
function resetForm() {
    document.getElementById("addRawMaterialForm").reset();
</script>

<script>
function showEditFormA(id, name, amount, unit, threshold) {
    document.getElementById("put_id").value = id;
    document.getElementById("put_name").value = name;
    document.getElementById("put_amount").value = amount;
    document.getElementById("put_unit").value = unit;
    document.getElementById("put_threshold").value = threshold;
}
</script>

<script>
function showEditFormB(id, name, amount, unit) {
    document.getElementById("editRawMaterialForm").reset();
    document.getElementById("put_id").value = id;
    document.getElementById("put_name").value = name;
    document.getElementById("put_amount").value = amount;
    document.getElementById("put_unit").value = unit;
}
</script>
@endsection