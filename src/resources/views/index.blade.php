@extends('clockworkview::layouts/master')

@section('main')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row request-index">
            <div class="col-md-12 col-sm-12">
                <table class="table table-hover">
                    <thead>
                    <th>Request Time</th>
                    <th>Method</th>
                    <th>Endpoint Path</th>
                    </thead>
                    <tbody>
                    @foreach($data as $request)
                        <tr class="selectable2" data="{{ $request['id'] }}">
                            <td>{{ $request['time'] }}</td>
                            <td>{{ $request['method'] }}</td>
                            <td>{{ $request['uri'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

        <div class="row hide" id="details-row">
            <div class="col-md-12 col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tabs">Details</a></li>
                    <li><a href="#headers" data-toggle="tabs">Headers</a></li>
                    <li><a href="#form-data" data-toggle="tabs">Form Data</a></li>
                    <li><a href="#timeline" data-toggle="tabs">Timeline</a></li>
                    <li><a href="#sql" data-toggle="tabs">SQL Queries</a></li>
                    <li><a href="#logs" data-toggle="tabs">Logs</a></li>
                </ul>

                <div id="my-tab-content" class="tab-content">

                    <!-- DETAILS -->

                    <div class="tab-pane active" id="details">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Clockwork ID</th>
                                <td> @{{ cw.id }}</td>
                            </tr>
                            <tr>
                                <th>Host</th>
                                <td>@{{ cw.headers.host }}</td>
                            </tr>
                            <tr>
                                <th>Response Code</th>
                                <td>@{{ cw.responseStatus }}</td>
                            </tr>
                            <tr>
                                <th>Method</th>
                                <td>@{{ cw.method }}</td>
                            </tr>
                            <tr>
                                <th>URI</th>
                                <td>@{{ cw.uri }}</td>
                            </tr>
                            <tr>
                                <th>Controller</th>
                                <td>@{{ cw.controller }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- HEADERS -->

                    <div class="tab-pane" id="headers">
                        <table class="table">
                            <tbody>
                            <tr v-for="header in cw.headers">
                                <th> @{{ $key }}</th>
                                <td> @{{ header }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- FORM DATA -->

                    <div class="tab-pane" id="form-data">
                        <div class="col-md-6">
                            <!-- GET DATA -->
                            <h4>GET Data</h4>
                            <table class="table">
                                <thead>
                                <th>Key</th>
                                <th>Value</th>
                                </thead>
                                <tbody>
                                <tr v-for="value in cw.getData">
                                    <th> @{{ $key }}</th>
                                    <td> @{{ value }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <!-- POST DATA -->
                            <h4>POST Data</h4>
                            <table class="table">
                                <thead>
                                <th>Key</th>
                                <th>Value</th>
                                </thead>
                                <tbody>
                                <tr v-for="value in cw.postData">
                                    <th> @{{ $key }}</th>
                                    <td> @{{ value }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TIMELINE -->

                    <!-- SQL QUERIES -->

                    <!-- LOGS -->
                    <div class="tab-pane" id="logs">
                        <table class="table">
                            <tbody>
                            <tr v-for="log in cw.log">
                                <td> @{{ log.message }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <script type="text/javascript">
        $(function() {
            $(".selectable2").click(function(e) {
                var id = $(this).attr('data');
                console.log(id);
                $.ajax({
                    url: '/dummy/'+id,
                    method: 'GET',
                    success: function(res) {
                        console.log("SWEET");
                    }
                })
            });
        });
    </script>
@stop