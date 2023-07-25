@extends('layouts.app')
@section('content')
 <div class="container brandlist-page">

                    <div class="row pl-3 pr-3">
                        <div class="col-md-6">
                            <form class="form-inline">
                                <a class="brand-title">Manage Notifications</a>
                                <div class="input-group">

                                    <input class="form-control" type="search" placeholder="Search by Name"
                                        aria-label="Search">
                                    <button type="button" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                        
                    </div>
                    <div class="brand-list-content">
                        <div class="card mt-3">
                            <div class="brandlist-table table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-2">S.NO</th>
                                            <th scope="col" class="col-md-5">Title</th>
                                            <th scope="col" class="col-md-3">Date</th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>The user has granted permission to display notifications, after having been asked previously</td>
                                            <td>10-03-2022</td>
                                            <td class="actions">
                                                <button type="button" class="edit"><img
                                                        src="images/icons/edit.svg"></button>
                                                <button type="button" class="delete"><img
                                                        src="images/icons/delete.svg"></button>
                                                <button type="button" class="add"><img
                                                        src="images/icons/add.svg"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>he callback version optionally accepts a callback function that is called once the user has responded to the request to display permissions</td>
                                            <td>09-03-2022</td>
                                            <td class="actions">
                                                <button type="button" class="edit"><img
                                                        src="images/icons/edit.svg"></button>
                                                <button type="button" class="delete"><img
                                                        src="images/icons/delete.svg"></button>
                                                <button type="button" class="add"><img
                                                        src="images/icons/add.svg"></button>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="btn-notification-add">
                                    <a href="admin-create-notification.html" class="btn btn-orange">Create Notification</a>
                                </div>
                            </div>

                        </div>
                        <div class="row dataTables_info justify-content-between" id="showingBrandEntries">
                            <div class="col-md-3">
                                <div class="listed-pages">

                                    <p>Showing 1 - 10 out of 50</p>
                                </div>
                            </div>
                            <div class="col-md-3 pagintion">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
@endsection