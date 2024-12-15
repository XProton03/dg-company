@extends('company.main')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img" style="background-image: url(img/bg-img/bg-contact.jpg);">
        <div class="bradcumbContent">
            <h2>Kontak Kami</h2>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Google Maps ##### -->
    <div class="map-area wow fadeInUp" data-wow-delay="300ms">
        <!--<div id="googleMap"></div>-->
        <iframe id="googleMap"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d37530.178214730404!2d115.21980986183172!3d-8.608090257577402!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7de80d4e82dbe5c8!2sOWNER+CV+DEA+GROUP!5e0!3m2!1sen!2sus!4v1552978317696"
            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4691.272272177758!2d115.23802924656037!3d-8.608090633828981!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7de80d4e82dbe5c8!2sOWNER+CV+DEA+GROUP!5e0!3m2!1sen!2sus!4v1552978192927" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    <iframe id="googleMap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1972.2885334134683!2d115.22302744358407!3d-8.63653662760742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f71ac158bb3%3A0xc1faaf8cc15842ca!2sCV+DEA+GROUP!5e0!3m2!1sid!2sid!4v1552558836421" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
    </div>

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-content">
                        <div class="row">
                            <!-- Contact Information -->
                            <div class="col-12 col-lg-5">
                                <div class="contact-information wow fadeInUp" data-wow-delay="400ms">
                                    <div class="section-heading text-left">
                                        <span>CV. DEA GROUP</span>
                                        <h3>Lokasi Kami</h3>
                                        <!--<p class="mt-30"> <b>Store</b> <br><i class="icon-placeholder"></i> Jl. Pulau Bawean No. 5 Denpasar, <br>
                                            <b>Service Centre</b> <br><i class="icon-placeholder"></i> Jl. Sari Gading No.16A Denpasar, <br>
                                            <b>Kantor Pelatihan SDM</b> <br><i class="icon-placeholder"></i> Perum Triyana Penatih Blok A13 Denpasar.</p>-->
                                    </div>

                                    <!-- Contact Social Info
                                        <div class="contact-social-info d-flex mb-30">
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </div>-->

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <p> <b>Beralamat di</b> <br> di Jl. Pulau Bawean No. 5 Denpasar, Bali.</p>
                                    </div>
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-customer-service"></i>
                                        </div>
                                        <p> <b>Service Centre</b> <br> Perum Triyana Blok A12, Jl. Nagasari, Penatih Dangin
                                            Puri, Denpasar Timur, Bali 80238</p>
                                    </div>
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-house"></i>
                                        </div>
                                        <p> <b>Kantor Pelatihan SDM</b> <br> Perum Triyana Blok A13, Jl. Nagasari, Penatih
                                            Dangin Puri, Denpasar Timur, Bali 80238</p>
                                    </div>

                                    <!-- Single Contact Info -->
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-telephone-3"></i>
                                        </div>
                                        <p>Office &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 0361 - 470 1065
                                        </p>
                                    </div>
                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-mobile-phone"></i>
                                        </div>
                                        <p>
                                            Mobile &nbsp;1&nbsp; : 08533 909 9090
                                            <br />
                                            Mobile 2&nbsp; : 08155 803 1078
                                        </p>
                                    </div>
                                    <!-- Single Contact Info -->

                                    <div class="single-contact-info d-flex">
                                        <div class="contact-icon mr-15">
                                            <i class="icon-contract"></i>
                                        </div>
                                        <p>info@cvdeagroup.com</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Form Area -->
                            <div class="col-12 col-lg-7">
                                <div class="contact-form-area wow fadeInUp" data-wow-delay="500ms">
                                    <form action="#" method="post">
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                        <input type="email" class="form-control" id="email" placeholder="E-mail">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                        <button class="btn academy-btn mt-30" type="submit">Contact Us</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->
@endsection
