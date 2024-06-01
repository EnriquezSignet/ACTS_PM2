<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bg-dark {
            background-color: #343a40 !important;
        }
        .bg-purple {
            background-color: #6f42c1 !important;
        }
        .bg-gradient-purple {
            background: linear-gradient(45deg, #6f42c1, #a078f0);
        }
        .text-light {
            color: #f8f9fa !important;
        }
        .card-outline {
            border-color: #6f42c1;
        }
        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-purple:hover {
            background-color: #5a34a0;
            border-color: #5a34a0;
        }
        .alert {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<!-- Header -->

<!-- Contact Form Section -->
<section class="py-5">
    <div class="container">
        <div class="card rounded-0 card-outline card-purple shadow px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4>Contact Form</h4>
                        <form id="contactForm">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-purple text-white mt-3">Send Message</button>
                        </form>
                        <div class="alert alert-success mt-3" id="successMessage" role="alert">
                            Your message has been sent successfully!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-purple text-light')
        } else {
           $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })

    $('#contactForm').on('submit', function(e) {
        e.preventDefault(); 
        $('#successMessage').fadeIn();
        $('#contactForm')[0].reset();
        setTimeout(function() {
            $('#successMessage').fadeOut();
        }, 5000);
    });
</script>
</body>
</html>
