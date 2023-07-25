@extends('layouts.app')
@section('content')
      <div class="container brandlist-page">

                    <div class="row pl-3 pr-3">
                        <a class="brand-title">Manage CMS</a>
                    </div>
                    <div class="brand-list-content">
                        <div class="card mt-3">
                            <div class="doctorlist-table table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-1 text-center">ID</th>
                                            <th scope="col" class="col-md-3">Title</th>
                                            <th scope="col" class="col-md-3">Created</th>
                                            <th scope="col" class="col-md-3">Modified</th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1024</td>
                                            <td>Privacy Policy</td>
                                            <td>May 5, 2022, 5:57 PM</td>
                                            <td>May 10, 2022, 9:57 AM</td>
                                            <td class="actions">
                                                <a href="admin-edit-cms.html" class="edit">
                                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.325 4.11766L15.8876 0.680256C15.439 0.258855 14.8511 0.017061 14.2358 0.000869084C13.6205 -0.0153228 13.0207 0.195217 12.5505 0.592439L1.2598 11.8832C0.854294 12.2921 0.601806 12.8281 0.544719 13.4012L0.00527272 18.6325C-0.0116271 18.8163 0.0122157 19.0015 0.0751012 19.175C0.137987 19.3485 0.238367 19.5059 0.369086 19.6362C0.486309 19.7524 0.625331 19.8444 0.778179 19.9069C0.931028 19.9693 1.0947 20.0009 1.2598 20H1.37271L6.60409 19.5233C7.17715 19.4662 7.71313 19.2137 8.12207 18.8082L19.4128 7.51743C19.851 7.05447 20.0879 6.43667 20.0714 5.7994C20.055 5.16213 19.7865 4.55738 19.325 4.11766ZM6.37827 17.0142L2.61469 17.3655L2.95341 13.6019L10.0415 6.60163L13.4287 9.98885L6.37827 17.0142ZM15.0596 8.30778L11.6975 4.94565L14.1438 2.43659L17.5687 5.86145L15.0596 8.30778Z"
                                                            fill="#818181" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#1026</td>
                                            <td>Terms and Conditions</td>
                                            <td>May 5, 2022, 5:57 PM</td>
                                            <td>May 10, 2022, 9:57 AM</td>
                                            <td class="actions">
                                                <a href="admin-edit-cms.html" class="edit">
                                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.325 4.11766L15.8876 0.680256C15.439 0.258855 14.8511 0.017061 14.2358 0.000869084C13.6205 -0.0153228 13.0207 0.195217 12.5505 0.592439L1.2598 11.8832C0.854294 12.2921 0.601806 12.8281 0.544719 13.4012L0.00527272 18.6325C-0.0116271 18.8163 0.0122157 19.0015 0.0751012 19.175C0.137987 19.3485 0.238367 19.5059 0.369086 19.6362C0.486309 19.7524 0.625331 19.8444 0.778179 19.9069C0.931028 19.9693 1.0947 20.0009 1.2598 20H1.37271L6.60409 19.5233C7.17715 19.4662 7.71313 19.2137 8.12207 18.8082L19.4128 7.51743C19.851 7.05447 20.0879 6.43667 20.0714 5.7994C20.055 5.16213 19.7865 4.55738 19.325 4.11766ZM6.37827 17.0142L2.61469 17.3655L2.95341 13.6019L10.0415 6.60163L13.4287 9.98885L6.37827 17.0142ZM15.0596 8.30778L11.6975 4.94565L14.1438 2.43659L17.5687 5.86145L15.0596 8.30778Z"
                                                            fill="#818181" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#1027</td>
                                            <td>About Us</td>
                                            <td>May 5, 2022, 5:57 PM</td>
                                            <td>May 10, 2022, 9:57 AM</td>
                                            <td class="actions">
                                                <a href="admin-edit-cms.html" class="edit">
                                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.325 4.11766L15.8876 0.680256C15.439 0.258855 14.8511 0.017061 14.2358 0.000869084C13.6205 -0.0153228 13.0207 0.195217 12.5505 0.592439L1.2598 11.8832C0.854294 12.2921 0.601806 12.8281 0.544719 13.4012L0.00527272 18.6325C-0.0116271 18.8163 0.0122157 19.0015 0.0751012 19.175C0.137987 19.3485 0.238367 19.5059 0.369086 19.6362C0.486309 19.7524 0.625331 19.8444 0.778179 19.9069C0.931028 19.9693 1.0947 20.0009 1.2598 20H1.37271L6.60409 19.5233C7.17715 19.4662 7.71313 19.2137 8.12207 18.8082L19.4128 7.51743C19.851 7.05447 20.0879 6.43667 20.0714 5.7994C20.055 5.16213 19.7865 4.55738 19.325 4.11766ZM6.37827 17.0142L2.61469 17.3655L2.95341 13.6019L10.0415 6.60163L13.4287 9.98885L6.37827 17.0142ZM15.0596 8.30778L11.6975 4.94565L14.1438 2.43659L17.5687 5.86145L15.0596 8.30778Z"
                                                            fill="#818181" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#1028</td>
                                            <td>Contact Us</td>
                                            <td>May 5, 2022, 5:57 PM</td>
                                            <td>May 10, 2022, 9:57 AM</td>
                                            <td class="actions">
                                                <a href="admin-edit-cms.html" class="edit">
                                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.325 4.11766L15.8876 0.680256C15.439 0.258855 14.8511 0.017061 14.2358 0.000869084C13.6205 -0.0153228 13.0207 0.195217 12.5505 0.592439L1.2598 11.8832C0.854294 12.2921 0.601806 12.8281 0.544719 13.4012L0.00527272 18.6325C-0.0116271 18.8163 0.0122157 19.0015 0.0751012 19.175C0.137987 19.3485 0.238367 19.5059 0.369086 19.6362C0.486309 19.7524 0.625331 19.8444 0.778179 19.9069C0.931028 19.9693 1.0947 20.0009 1.2598 20H1.37271L6.60409 19.5233C7.17715 19.4662 7.71313 19.2137 8.12207 18.8082L19.4128 7.51743C19.851 7.05447 20.0879 6.43667 20.0714 5.7994C20.055 5.16213 19.7865 4.55738 19.325 4.11766ZM6.37827 17.0142L2.61469 17.3655L2.95341 13.6019L10.0415 6.60163L13.4287 9.98885L6.37827 17.0142ZM15.0596 8.30778L11.6975 4.94565L14.1438 2.43659L17.5687 5.86145L15.0596 8.30778Z"
                                                            fill="#818181" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        
                    </div>
                </div>
@endsection