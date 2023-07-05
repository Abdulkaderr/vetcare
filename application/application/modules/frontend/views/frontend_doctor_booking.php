<body>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-9xsv3q6P0d6eHfIg0oGASBaK6OzJ0Sll+v/q2XsK1AZaJJS4u4F0o2mykePe1hqwDoyyilc70rWnXbhXnBmL/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <style>
            .activedate {
                background-color: aqua;
            }

            .date-list-container {
                width: 100%;
                overflow-x: auto;
            }

            .day-slot {
                display: flex;
                flex-wrap: nowrap;
            }

            .date-item {
                flex: 0 0 auto;
                font-size: 19px;
                width: 200px;
                height: 70px;
                margin-right: 10px;
                /* border: 1px solid black; */
                box-sizing: border-box;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Booking</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Booking</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="booking-doc-info">
                                    <a href="doctor-profile.html" class="booking-doc-img">
                                        <img src="<?php echo $doctor->img_url; ?>" alt="User Image">
                                    </a>
                                    <div class="booking-info">
                                        <h4><a href="doctor-profile.html"><?php echo $doctor->name; ?></a></h4>

                                        <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo $this->department_model->getDepartmentById($doctor->department)->name; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>









                        <?php if (!$this->ion_auth->in_group(array('Owner'))) { ?>

                        <section class="section section-doctor">
                            <div class="container-fluid">
                                <div class="section-header text-center aos" data-aos="fade-up">
                                   
                                        <h4>Please login <span style="color:green;"> as a owner</span> to select your pet & make appointment </h4>
                                        <div class="row row-sm">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-2"> <button type="button" class="btn btn-primary" id="login" data-bs-toggle="modal" data-bs-target="#modalForm">
                                                    Login Now
                                                </button>
                                            </div>
                                            <div class="col-md-5"></div>
                                        </div>




                                   
                                    <div class="account-content login">
                                        <div class="row align-items-center justify-content-center">

                                            <div class="col-md-12 col-lg-6 login-right">
                                                <div class="login-header">
                                                    <h3>Login <span></span></h3>
                                                </div>
                                                <form class="form-signin" method="post" action="auth/login">
                                                    <div class="form-group form-focus">
                                                        <input type="text" name="identity" class="form-control floating">
                                                        <label class="focus-label">Email</label>
                                                    </div>
                                                    <div class="form-group form-focus">
                                                        <input type="password" name="password" class="form-control floating">
                                                        <label class="focus-label">Password</label>
                                                    </div>
                                                    <input type="hidden" name="redirect" value="<?php echo $doctor->id; ?>">
                                                    <button class="btn btn-primary w-100 btn-lg login-btn" type="submit">Login</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <h2>Select Your Pet</h2> -->
                                </div>
                               
                                    <!-- <div class="row">
                                        <div class="col-lg-12 aos" data-aos="fade-up">
                                            <div class="doctor-slider slider">
                                                
                                                <?php foreach ($patients as $patient) { ?>
                                                    <div class="profile-widget" data-id="<?php echo $patient->id; ?>">
                                                        <div class="doc-img">

                                                            <img class="img-fluid" style="height:200px;" alt="User Image" src="<?php if (!empty($patient->img_url)) {
                                                                                                                                    echo $patient->img_url;
                                                                                                                                } else {
                                                                                                                                    echo 'petcare/assets/img/b2.jpg';
                                                                                                                                } ?>">




                                                        </div>
                                                        <div class="pro-content">
                                                            <h3 class="title">
                                                                <a href="">Type pet: <?php echo $patient->bloodgroup; ?></a>
                                                                <i class="fas fa-check-circle verified"></i>
                                                            </h3>

                                                            <ul class="available-info">
                                                                <li> <i class="fas fa-map-marker-alt"></i> <?php echo $patient->name; ?></li><br>
                                                                </li>
                                                            </ul>

                                                        </div>




                                                    </div>

                                                <?php } ?>



                                            </div>
                                        </div>
                                    </div> -->

                            </div>
                        </section>

                        <?php } ?>


                        <form action="frontend/addNew" method="post" id="addAppointmentForm">


                        <?php 
                         if ($this->ion_auth->in_group(array('Owner'))) {
                        $owner_ion_id = $this->ion_auth->get_user_id();
                        $owner = $this->db->get_where('owner', array('ion_user_id' => $owner_ion_id))->row()->id; ?>



                        <input type="hidden" id="owner" name="owner" value="<?php echo $owner; ?>">
                        <?php } ?>
                        <input type="hidden" id="patient" name="patient">
                        <input type="hidden" id="selectedSlot" name="time_slot">
                        <input type="hidden" name="date" id="date" value="<?php echo date("d-m-Y") ?>">
                        <input type="hidden" name="doctor" id="doctor" value="<?php echo $doctor->id; ?>">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-6">
                                <h4 class="mb-1"><?php
                                                    echo date("j F Y");
                                                    ?></h4>
                                <p class="text-muted"><?php
                                                        echo date("l");
                                                        ?></p>
                            </div>
                            <div class="col-12 col-sm-8 col-md-6 text-sm-end">
                                <div class=" btn btn-white btn-sm mb-3">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <span></span>
                                    <i class="fas fa-chevron-down ms-2"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Widget -->
                        <div class="card booking-schedule schedule-widget">

                            <div class="date-list-container">
                                <div class="day-slot">
                                    <?php for ($i = 1; $i <= 365; $i++) { ?>
                                        <!-- <div class="date-item slot-date">January 1, 2023</div>; -->

                                        <span class="date-item slot-date">11 Nov <small class="slot-year">2019</small></span>
                                    <?php   }
                                    ?>

                                </div>
                            </div>


                            <!-- Schedule Content -->
                            <div class="schedule-cont">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Time Slot -->
                                        <div class="time-slot">
                                            <ul class="clearfix slot"></ul>
                                        </div>


                                        <!-- /Time Slot -->

                                    </div>
                                </div>
                            </div>
                            <!-- /Schedule Content -->

                        </div>
                        <!-- /Schedule Widget -->
                        <div class="submit-section proceed-btn text-end">
                            <select name="serv_type" class="form-control">
                                <option value="treatment">Treatment</option>
                                <option value="shave_and_bath">Shave and bath</option>
                                <option value="vaccines">Vaccines</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Submit Section -->
                        <div class="submit-section proceed-btn text-end">

                            <button type="submit" name="submit" class="btn btn-primary submit-btn"><?php echo lang('submit'); ?></button>
                        </div>
                        <!-- /Submit Section -->
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Page Content -->



    </div>
    <!-- /Main Wrapper -->

    </div>
    <script src="common/js/codearistos.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-4t8LdL1yr4b2G4mcEbo7AsCY5W5YX9Gby5FHUpHx7up1heWRYiIOgF/ZJZd/hV7H8jWYVyX7M1QQCtbNdV6U2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script>
        $(document).ready(function() {
            "use strict";
            $("#date")
                .datepicker({
                    format: "dd-mm-yyyy",
                    autoclose: true,
                })
                //Listen for the change even on the input
                .change(dateChanged)
                .on("changeDate", dateChanged);
        });

        $(document).ready(function() {
            "use strict";



            var doctorr = $("#doctor").val();
            var date = $("#date").val();

            $("#selectedSlot").val("");
            $("#aslots").find("button").remove();

            if (date != "") {
                $.ajax({
                    url: "frontend/getAvailableSlotByDoctorByDateByJason?date=" +
                        date +
                        "&doctor=" +
                        doctorr,
                    method: "GET",
                    data: "",
                    dataType: "json",
                    success: function(response) {
                        "use strict";

                        var slots = response.aslots;
                        $(".slot").empty();
                        if (slots.length == 0) {
                            $(".slot")
                                .append(
                                    '<div class="col-md-12 text-center">No Available Slot Found!</div>'
                                )
                                .end();
                        } else {
                            $.each(slots, function(key, value) {
                                var timeDisplay = '<li style="margin:5px;"><button type="button" style="border: 1px solid gray; width:165px;" class="timing" data-id="' + value + '" href="#"><span>' + value + '</span> </button></li>';
                                var $timeDisplay = $(timeDisplay); // create a jQuery object from the HTML string
                                $timeDisplay.find('button').click(function() { // add a click event listener to the button
                                    $('.timing').css({
                                        'background-color': '',
                                        'color': '',
                                        'border': ''
                                    });;
                                    $(this).css({
                                        'background-color': '#42c0fb',
                                        'color': 'white',
                                        'border': '1px solid #42c0fb'
                                    });
                                    $('#selectedSlot').val($(this).data('id'));
                                });

                                $(".slot").append($timeDisplay).end();
                            });
                        }
                    },
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var currentDate = new Date();

            $('.slot-date').each(function() {
                var $dateElement = $(this);
                var day = currentDate.getDate().toString().padStart(2, '0');
                var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                var year = currentDate.getFullYear();
                var dateString = day + '-' + month + '-' + year;
                var dayName = currentDate.toLocaleString('default', {
                    weekday: 'short'
                });
                $dateElement.text(dayName + ', ' + day + ' ' + currentDate.toLocaleString('default', {
                    month: 'short'
                }) + ' ' + year);
                $dateElement.on('click', function() {
                    $('.slot-date').removeClass('activedate');
                    $dateElement.addClass('activedate');
                    $('#date').val(dateString);
                    // alert('You clicked on ' + dateString);
                    var doctorr = $("#doctor").val();
                    var date = $("#date").val();

                    $("#selectedSlot").val("");
                    $("#aslots").find("button").remove();

                    if (date != "") {
                        $.ajax({
                            url: "frontend/getAvailableSlotByDoctorByDateByJason?date=" +
                                date +
                                "&doctor=" +
                                doctorr,
                            method: "GET",
                            data: "",
                            dataType: "json",
                            success: function(response) {
                                "use strict";

                                var slots = response.aslots;
                                $(".slot").empty();
                                if (slots.length == 0) {
                                    $(".slot")
                                        .append(
                                            '<div class="col-md-12 text-center">No Available Slot Found!</div>'
                                        )
                                        .end();
                                } else {

                                    $.each(slots, function(key, value) {
                                        var timeDisplay = '<li style="margin:5px;"><button type="button" style="border: 1px solid gray; width:165px;" class="timing" data-id="' + value + '" href="#"><span>' + value + '</span> </button></li>';
                                        var $timeDisplay = $(timeDisplay); // create a jQuery object from the HTML string
                                        $timeDisplay.find('button').click(function() { // add a click event listener to the button
                                            $('.timing').css({
                                                'background-color': '',
                                                'color': '',
                                                'border': ''
                                            });;
                                            $(this).css({
                                                'background-color': '#42c0fb',
                                                'color': 'white',
                                                'border': '1px solid #42c0fb'
                                            });
                                            $('#selectedSlot').val($(this).data('id'));
                                        });

                                        $(".slot").append($timeDisplay).end();
                                    });
                                }
                            },
                        });
                    }
                });
                currentDate.setDate(currentDate.getDate() + 1);
            });
        });
    </script>
    <script>
        $(".profile-widget").click(function() {
            $('.profile-widget').css({
                // 'border': '',
                'color': '',
                'border': ''
            });;
            $(this).css({
                // 'background-color': '#42c0fb',
                'color': 'white',
                'border': '1px solid #42c0fb'
            });
            $('#patient').val($(this).data('id'));
        });
    </script>

    <script>
        $(document).ready(function() {
            "use strict";
            $(".login").hide();
            $(document.body).on("click", "#login", function() {
                "use strict";
                $.ajax({
                    url: 'auth/logout',
                    method: 'POST',
                    success: function(data) {
                        // handle success response from server
                    },
                    error: function(error) {
                        // handle error response from server
                    }
                });
                $(".login").show();
                $("#login").hide();

            });




        });
        $(document).ready(function() {
            "use strict";
            $(".login").hide();
            $(document.body).on("click", "#log_in", function() {
                "use strict";
                $.ajax({
                    url: 'auth/logout',
                    method: 'POST',
                    success: function(data) {
                        // handle success response from server
                    },
                    error: function(error) {
                        // handle error response from server
                    }
                });
                $(".login").show();
                $("#login").hide();

            });




        });
    </script>

    <script>
        $(document).ready(function() {
            $('.image-list-container').on('mousewheel DOMMouseScroll', function(e) {
                var delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
                this.scrollLeft += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            });
        });
    </script>