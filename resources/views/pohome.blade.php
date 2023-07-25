@extends('layouts.poapp')
@section('content')
<div class="container client-dashboard mt-4">
    <div class="ff-dashboard-date align-items-center">
        <h3>Dashboard</h3>
    </div>
    <br><br>
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        <div class="card-cd-option">
                        </div>
                    </a>
                </div>
                <a href="">
                    <div class="card-body">
                        <div class="cd-card-icon cd-bg-blue">
                            <svg width="27" height="30" viewBox="0 0 27 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3125 0C9.56658 0 8.85121 0.296316 8.32376 0.823762C7.79632 1.35121 7.5 2.06658 7.5 2.8125V4.6875C7.5 5.43342 7.79632 6.14879 8.32376 6.67624C8.85121 7.20368 9.56658 7.5 10.3125 7.5H15.9375C16.6834 7.5 17.3988 7.20368 17.9262 6.67624C18.4537 6.14879 18.75 5.43342 18.75 4.6875V2.8125C18.75 2.06658 18.4537 1.35121 17.9262 0.823762C17.3988 0.296316 16.6834 0 15.9375 0L10.3125 0ZM15.9375 1.875C16.1861 1.875 16.4246 1.97377 16.6004 2.14959C16.7762 2.3254 16.875 2.56386 16.875 2.8125V4.6875C16.875 4.93614 16.7762 5.1746 16.6004 5.35041C16.4246 5.52623 16.1861 5.625 15.9375 5.625H10.3125C10.0639 5.625 9.8254 5.52623 9.64959 5.35041C9.47377 5.1746 9.375 4.93614 9.375 4.6875V2.8125C9.375 2.56386 9.47377 2.3254 9.64959 2.14959C9.8254 1.97377 10.0639 1.875 10.3125 1.875H15.9375Z" fill="white" />
                                <path d="M5.625 2.8125H3.75C2.75544 2.8125 1.80161 3.20759 1.09835 3.91085C0.395088 4.61411 0 5.56794 0 6.5625V26.25C0 27.2446 0.395088 28.1984 1.09835 28.9016C1.80161 29.6049 2.75544 30 3.75 30H22.5C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25V6.5625C26.25 5.56794 25.8549 4.61411 25.1516 3.91085C24.4484 3.20759 23.4946 2.8125 22.5 2.8125H20.625V4.6875C20.625 5.30307 20.5038 5.91262 20.2682 6.48133C20.0326 7.05004 19.6873 7.56679 19.2521 8.00206C18.8168 8.43734 18.3 8.78262 17.7313 9.01819C17.1626 9.25375 16.5531 9.375 15.9375 9.375H10.3125C9.0693 9.375 7.87701 8.88114 6.99794 8.00206C6.11886 7.12299 5.625 5.9307 5.625 4.6875V2.8125ZM16.875 15C16.875 14.5027 17.0725 14.0258 17.4242 13.6742C17.7758 13.3225 18.2527 13.125 18.75 13.125C19.2473 13.125 19.7242 13.3225 20.0758 13.6742C20.4275 14.0258 20.625 14.5027 20.625 15V24.375C20.625 24.8723 20.4275 25.3492 20.0758 25.7008C19.7242 26.0525 19.2473 26.25 18.75 26.25C18.2527 26.25 17.7758 26.0525 17.4242 25.7008C17.0725 25.3492 16.875 24.8723 16.875 24.375V15ZM5.625 22.5C5.625 22.0027 5.82254 21.5258 6.17418 21.1742C6.52581 20.8225 7.00272 20.625 7.5 20.625C7.99728 20.625 8.47419 20.8225 8.82582 21.1742C9.17746 21.5258 9.375 22.0027 9.375 22.5V24.375C9.375 24.8723 9.17746 25.3492 8.82582 25.7008C8.47419 26.0525 7.99728 26.25 7.5 26.25C7.00272 26.25 6.52581 26.0525 6.17418 25.7008C5.82254 25.3492 5.625 24.8723 5.625 24.375V22.5ZM13.125 16.875C13.6223 16.875 14.0992 17.0725 14.4508 17.4242C14.8025 17.7758 15 18.2527 15 18.75V24.375C15 24.8723 14.8025 25.3492 14.4508 25.7008C14.0992 26.0525 13.6223 26.25 13.125 26.25C12.6277 26.25 12.1508 26.0525 11.7992 25.7008C11.4475 25.3492 11.25 24.8723 11.25 24.375V18.75C11.25 18.2527 11.4475 17.7758 11.7992 17.4242C12.1508 17.0725 12.6277 16.875 13.125 16.875Z" fill="white" />
                            </svg>

                        </div>
                        <div class="cd-card-content">
                            <p>Total Number of<br>
                                <span class="blue-span">Po Entries</span>
                            </p>
                        </div>
                        <div class="cd-card-count">
                            <h3 id="rx_count" name="rx_count">5</h3>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        <div class="card-cd-option">
                        </div>
                    </a>
                </div>
                <a href="">
                    <div class="card-body">
                        <div class="cd-card-icon cd-bg-green">
                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <mask id="mask0_306_755" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="35" height="35">
                                    <rect width="35" height="35" fill="url(#pattern0)" />
                                </mask>
                                <g mask="url(#mask0_306_755)">
                                    <rect y="-6.67944" width="44.6183" height="48.626" fill="white" />
                                </g>
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_306_755" transform="scale(0.00195312)" />
                                    </pattern>
                                    <image id="image0_306_755" width="512" height="512" xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>

                        </div>
                        <div class="cd-card-content">
                            <p>Total Number of<br>
                                <span class="green-span">PO Values</span>
                            </p>
                        </div>
                        <div class="cd-card-count">
                            <h3 id="cycle_count" name="cycle_count">16L</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        <div class="card-cd-option">
                        </div>
                    </a>
                </div>
                <a href="">
                    <div class="card-body">

                        <div class="cd-card-icon cd-bg-orange">
                            <svg width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 0H3C1.35 0 0.0150003 1.35 0.0150003 3L0 27C0 28.65 1.335 30 2.985 30H21C22.65 30 24 28.65 24 27V9L15 0ZM18 24H6V21H18V24ZM18 18H6V15H18V18ZM13.5 10.5V2.25L21.75 10.5H13.5Z" fill="white" />
                            </svg>
                        </div>


                        <div class="cd-card-content">
                            <p>Highest<br>
                                <span class="high-span">PO Value</span>
                            </p>
                        </div>
                        <div class="cd-card-count">
                            <h3 id="cycle_count" name="cycle_count">13L</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        <div class="card-cd-option">
                        </div>
                    </a>
                </div>
                <a href="">
                    <div class="card-body">

                        <div class="cd-card-icon cd-bg-yellow">
                            <svg width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 0H3C1.35 0 0.0150003 1.35 0.0150003 3L0 27C0 28.65 1.335 30 2.985 30H21C22.65 30 24 28.65 24 27V9L15 0ZM18 24H6V21H18V24ZM18 18H6V15H18V18ZM13.5 10.5V2.25L21.75 10.5H13.5Z" fill="white" />
                            </svg>
                        </div>


                        <div class="cd-card-content">
                            <p>Lowest <br>
                                <span class="low-span">PO Value</span>
                            </p>
                        </div>
                        <div class="cd-card-count">
                            <h3 id="cycle_count" name="cycle_count">0.4L</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>x


<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' +
                end.format('YYYY-MM-DD'));
            new_function(start, end);
        });
    });

    function new_function(start, end) {
        var start_date = start.format('YYYY-MM-DD');
        var end_date = end.format('YYYY-MM-DD');
        $.ajax({
            type: "get",
            url: "{{url('/fetch_dashboard_details')}}",
            async: true,
            data: {
                _token: token,
                brand_id: $('#brand_id').val(),
                start_date: start_date,
                end_date: end_date
            },
            success: function(response) {
                console.log(response);
                if (response.success == '1') {
                    var data = response.data;
                    $("#cycle_count").html(data.cycle_count);
                    $("#rx_count").html(data.rx_entry_count);
                    $("#prescription_count").html(data.prescription_count);
                }
            }
        });
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'click'
        })
    })

    let token = "{{csrf_token()}}";
    (function($) {
        $('#brand_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: "{{url('/fetch_dashboard_details')}}",
                // url: '/fetch_dashboard_details',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val()
                },
                success: function(response) {
                    console.log(response);
                    if (response.success == '1') {
                        var data = response.data;
                        $("#cycle_count").html(data.cycle_count);
                        $("#rx_count").html(data.rx_entry_count);
                        $("#prescription_count").html(data.prescription_count);
                    } else {}
                }
            });
        });
    })(jQuery);
</script>

@endsection