@extends('backend.index')

@section('title', 'Basic Stock Manager' . ' | ' . 'Admin Dashboard')

@section('breadcrumb-links')
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1">Stocks</h2>
                <div class="bs-example widget-shadow" data-example-id="contextual-table">
                    <h4>Stocks List</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Unique Prefix</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active">
                            <th scope="row">1</th>
                            <td>Make Stock</td>
                            <td>Stock by Make Group</td>
                            <td>Active</td>
                            <td>mgs</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
