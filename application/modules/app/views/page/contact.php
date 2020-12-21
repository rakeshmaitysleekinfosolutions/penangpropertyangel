<!----------------------contact ------------------------->
<section class="contact">
    <div class="container">
        <h2>CONTACT US</h2>
        <div class="row">
            <div class="col-md-8 col-12">
                <div class="contact_info">
                    <h4>For more information</h4>
                    <ul>
                        <li><span>T</span> +6016 496 7718</li>
                        <li><span>E</span> penangpropertyangel@gmail.com</li>
                        <li><span>A</span> 508-2-3A Tanjung Point,<br>
                            <span></span>Jalan Tanjung Tokong,<br>
                            <span></span>10470 Tokong, Penang, Malaysia.</li>
                    </ul>
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7943.381700639568!2d100.301831!3d5.463793!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xaf1be99ae0054997!2sPenang%20Property%20Angel!5e0!3m2!1sen!2smy!4v1608183583657!5m2!1sen!2smy" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 contact_form" id="contact-frm">
                <h4>Contact Us</h4>
                <div id="message"></div>
                <form class="contact" id="frmContact" action="<?php echo url('/contact');?>" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="no">Contact no.</label>
                        <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="sub">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="sub">Message</label>
                        <textarea id="message" name="message" rows="4" cols="21" autocomplete="off" required></textarea>
                    </div>

                    <div class="form-group">
                        <img src="<?php echo $builder->inline();?>" />
                    </div>
<!--                    <p>--><?php //echo getSession('phrase');?><!--</p>-->
                    <div class="form-group">
                        <label for="image">Image Varification</label>
                        <input type="text" class="form-control" placeholder="<?php echo getSession('phrase');?>" id="code" name="code" autocomplete="off" required>
                    </div>

                    <button type="submit" class="btn contact-frm-submit-btn">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    var myLabel             = myLabel || {};
    myLabel.baseUrl         = '<?php echo base_url();?>';
</script>