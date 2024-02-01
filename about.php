<?php 
   include 'header.php';
?>

        <style>
            .container-main {
                width: 80%;
                background-color: #B2BEB5;
                padding: 50px;
                margin: auto;
                background-image: url("images/img13.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
            }

            .container {
                padding-top: 3%;
            }

            .imgcon {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 15px;
                font-family: verdana;
            }

            .img1,
            .img2,
            .img3 {
                width: 20%;
                margin: 5px 5px;
                box-sizing: border-box;
                text-align: center;
            }

            .img1 img,
            .img2 img,
            .img3 img {
                width: 60%;
                height: auto;
                border-radius: 50%;
                object-fit: cover;
                margin-top: 10px;
            }

            .footer {
                color: #a9a9a9;
                padding: 20px 0;
                text-align: center;
                margin-top: 10px;
                font-family: Monospace;
            }
        </style>

        <div class="container-main">
            <center>
                <h2><strong>ABOUT US</strong></h2><br>
                <hr>

                <div class="">
                    <p style="font-family:verdana">"In the ever-evolving terrain of contemporary workplaces,
                        effective employee monitoring is not about micromanagement but rather a strategic tool for fostering
                        growth and productivity. Our monitoring solutions prioritize transparency and collaboration,
                        aiming to empower teams with valuable insights that lead to informed decision-making."
                    </p>
                </div>
                <hr>
                <h5><span style="color:white; background-color:grey; font-family:Serif;">The Team</span></h5>
            </center>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="imgcon">
                        <div class="img1">
                            <strong>Paulyn Joy Bito-on</strong>
                            <img src="images/img6.jpg" alt="">
                        </div>
                        <div class="img2">
                            <strong>John Paul Bibay</strong>
                            <img src="images/img5.jpg" alt="">
                        </div>
                        <div class="img3">
                            <strong>Jaymar Cerna</strong>
                            <img src="images/img8.jpeg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>Contact us:</p>
                <p>Email: example@example.com</p>
                <p>Contact Number: +1 123-456-7890</p>
            </div>
        </div>


   </body>

   </html>