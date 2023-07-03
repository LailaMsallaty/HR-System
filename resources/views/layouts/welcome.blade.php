<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special project</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/master.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" >

</head>
<body>

   <!-- start landing shift  -->
<div class="landing-nav">
    <div class="overlay"></div>
    <div class="container">
       <div class="header">

            <div class="header-area">
              <img class="logo" src="{{URL::asset('assets/images/depositphotos_334179998-stock-illustration-letter-logo-design-vector-template.jpg')}}">
              <div class="links-container">

                    <ul class="links">
                        <li><a href="#" data-section=".about">About</a></li>
                        <li><a href="#" data-section=".my-services">Features</a></li>
                        <li><a href="#" data-section=".testimonials">testimontials</a></li>

                    </ul>
                    <button class="toggle-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

             </div>

           </div>


            <div class="info">
                <h2>Welcome To Our HR System</h2>
                <p>Software Services</p>
                <a  href="{{ route('login') }}"><button>Log In</button></a>
            </div>
        </div>
            <div class="clearfix"></div>
    </div>

 </div>
   <!-- end landing shift  -->

<!-- Start  header -->

        <section>

        </section>
<!-- End  header -->
<!-- Start About -->
 <section class="about">
    <div class="container">
        <div class="info">
            <h2>About Us</h2>

            <p>Greetings ! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!</p>

        </div>
        <div class="image">
            <img src="{{URL::asset('assets/images/javascript-frameworks-concept-illustration_114360-734.jpg')}}" alt=""/>
        </div>
    </div>
 </section>
<!-- End About -->
<!--Start My-Services-->
<section class="my-services">
    <div class="container">
        <div class="heading">
            <h2>Our Features</h2>
        </div>
        <div class="item">
                <img src="{{URL::asset('assets/images/design.png')}}" alt="">
                <h4>Good Web Design</h4>
                <p>The different areas of web design include web graphic design, interface design, authoring , including standardised code and proprietary software, user experience design, and search engine optimization.</p>
        </div>

        <div class="item">
            <img src="{{URL::asset('assets/images/calendar.png')}}" alt="">
            <h4>Time Management</h4>
            <p>Managing stakeholder expectations is the most involved aspect of project management and carries the greatest cost for blunders.it is in this sense involves not only the amount of time needed per item .</p>
        </div>

        <div class="item">
            <img src="{{URL::asset('assets/images/time-management.png')}}" alt="">
            <h4>Project Management</h4>
            <p>Application of processes, methods, skills, knowledge and experience to achieve specificproject objectives according to the project acceptance criteria within agreed parameters.</p>
        </div>
    </div>
</section>
<div class="clearfix"></div>

<hr>
<!--End My-Services-->

<!-- Start testimontials-->

    <div class="testimonials">
        <div class="container">
                <h2>Testimonials</h2>
                <div class="ts-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!</p>
                    <div class="person-info">
                        <img src="https://placehold.it/80/DDD" alt="">
                        <h4>Natali</h4>
                        <p>CEO At Company</p>
                    </div>
                </div>
                <div class="ts-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!</p>
                    <div class="person-info">
                        <img src="https://placehold.it/80/EEE" alt="">
                        <h4>Judi</h4>
                        <p>CEO At Company</p>
                    </div>
                </div>
                <div class="ts-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur in incidunt pariatur animi blanditiis perspiciatis!</p>
                    <div class="person-info">
                        <img src="https://placehold.it/80/AAA" alt="">
                        <h4>Sara</h4>
                        <p>CEO At Company</p>
                    </div>
                </div>
                <div class="clearfix"></div>

         </div>


     </div>
<!-- End testimontials-->

<!--Start Nav Bullets-->
     <div class="nav-bullets">

        <div class="bullet" data-section=".about">
            <div class="tooltip">About Me</div>
        </div>
        <div class="bullet" data-section=".my-services">
            <div class="tooltip">Our Features</div>
        </div>
        <div class="bullet" data-section=".testimonials">
            <div class="tooltip">Testimonials</div>
        </div>
     </div>
<!--End Nav Bullets-->

<!--Start Footer -->

 <div class="footer">Created By joud Almuhammed
     <br>
     Contact Me : 0897986995 &copy; 2022
 </div>

<!--Start Footer -->


</body>
<script src="{{URL::asset('assets/js/master.js')}}"></script>
</html>
