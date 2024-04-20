<header class="app-header"><a class="app-header__logo" href="/" style="font-family: 'Times New Roman', Times, serif; color: white;">CRM System</a>
   
   
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
   

    <ul class="app-nav">

        <a class="app-nav__item" href="{{route('viewqueries')}}" id="notification-icon">
            <i class="fa fa-bell fa-lg"></i>
            <span class="badge badge-pill badge-danger" id="notification-count">0</span> 
        </a>
        

        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
           
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                
                <li><a class="dropdown-item" href="{{route('edit_profile')}}"><i class="fa fa-user fa-lg"></i> View Profile</a></li>
             
                <li><a class="dropdown-item" href="{{route('update_password')}}"><i class="fa fa-cog fa-lg"></i>Change Password</a></li>           

                <li><a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                   
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>


</header>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009688; color: white;">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-0W9Bn0fH4eekcBzzOtPx8V2vSPbXrQ+T8rgoGxh1jVXbJpj3GnMAe+mg6ZizwuybDzIRSRWW6n+oxi0+dd6hlQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
</script>

<script>
    $(document).ready(function() {
        var styles = `
            .modal-body {
                // max-height: 400px; / Adjust this height as needed /
                max-height: auto;
                overflow-y: auto;
            }
            .query-row {
                border-bottom: 2px solid #ccc;
                padding: 5px 0;
                margin-left: 4%;
            }
            .row {
                display: flex;
                justify-content: space-between;
            }
            .col {
                flex: 2;
                padding: 2px;
            }
            .read-more {
                cursor: pointer;
                color: blue;
                text-decoration: underline;
            }
            .full-message {
                display: none;
            }
        `;
        
        var styleElement = document.createElement('style');
        styleElement.innerHTML = styles;
        document.head.appendChild(styleElement);

        function updateNotificationCount() {
            $.ajax({
                url: '{{ route("fetch_notifications_count") }}',
                type: 'GET',
                success: function(response) {
                    $('#notification-count').text(response.count);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        updateNotificationCount();

        $('#notification-icon').click(function(e) {
            e.preventDefault();
            $('#notificationModal').modal('show');

            $.ajax({
                url: '{{ route("fetch_notifications") }}',
                type: 'GET',
                success: function(response) {
                    $('.modal-body').empty();

                    response.reverse();


                    $.each(response, function(index, notification) {
                        var row = '<div class="query-row">';
                        row += '<div class="row"><div class="col">Email: ' + notification.email + '</div><div class="col">' + formatDate(notification.created_at) + '</div></div>';

                        row += '<div class="row"><div class="col">Subject: ' + notification.query_subject + '</div></div>';

                        var message = notification.query_message;

                        if (message.split(/\s+/).length > 9) {
                            var partialMessage = message.split(/\s+/).slice(0, 9).join(" ");
                            var fullMessage = message;
row += '<div class="row"><div class="col" style="color: #007bff;">Query: <span class="partial-message">' + partialMessage + '... <span class="read-more">Read more</span></span><span class="full-message" style="display: none;">' + fullMessage + '</span></div></div>';

                        } else {
                            row += '<div class="row"><div class="col" style="color: #007bff;">Query: ' + message + '</div></div>';
                        }
                         row += '<div class="row"><div class="col text-center"><button id="id" class="btn btn-sm btn-success read-button" data-query-id=" '+notification.id+' ">Read</button></div></div>';


                        row += '</div>';
                        $('.modal-body').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('.modal-body').on('click', '.read-more', function() {
            $(this).closest('.query-row').find('.partial-message').hide();
            $(this).closest('.query-row').find('.full-message').show();
        });


        $('.modal-body').on('click', '.read-button', function() {
            var queryId = $(this).data('query-id');
            $.ajax({
                url: '/update-query-status/' + queryId,
                type: 'GET', 
                success: function(response) {
                    $(this).closest('.query-row').remove();
                    console.log('Query status updated successfully');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });



        function formatDate(dateTimeString) {
        var currentDate = new Date();
        var createdAtDate = new Date(dateTimeString);

        if (createdAtDate.toDateString() === currentDate.toDateString()) {
            return 'Today ' + createdAtDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        } else if (createdAtDate.getDate() === currentDate.getDate() - 1) {
            return 'Yesterday ' + createdAtDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        } else {
            return createdAtDate.toLocaleDateString() + ' ' + createdAtDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
    }


    });
</script> 




