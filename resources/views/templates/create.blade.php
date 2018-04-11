@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Add New Template</h1>
            <hr>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/templates" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="ad">Ad</option>
                                <option value="page">Landing Page</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Example: Half Page Ad Template">
                        </div>

                        <div class="form-group">
                            <label for="components">Components</label>
                            <input type="text" class="form-control" id="components" placeholder="Example: Half Page Ad Template">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
