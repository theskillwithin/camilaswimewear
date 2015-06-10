<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content.
 *
 * @package WordPress
 * @subpackage Pufferfish
 * @since Pufferfish 1.0
 */
?>
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div id="size-chart" style="display:none;">
						<table class="table table-striped">
							<tbody>
								<tr>
									<th></th>
									<th>X-Small</th>
									<th>Small</th>
									<th>Medium</th>
									<th>Large</th>
								</tr>
								<tr>
									<td>Bust</td>
									<td>32-33</td>
									<td>34</td>
									<td>35-36</td>
									<td>37-38</td>
								</tr>
								<tr>
									<td>Waist</td>
									<td>24-25</td>
									<td>26-27</td>
									<td>28-29</td>
									<td>30-31</td>
								</tr>
								<tr>
									<td>Hip</td>
									<td>34-35</td>
									<td>36-37</td>
									<td>38-39</td>
									<td>40-41</td>
								</tr>
							</tbody>
						</table>                    
					</div>
					<a style="display:none;" class="emailfail modal-fancybox" href="#EmailError">fail</a>
					<div style="display:none;" id="EmailError">
						<div class="alert alert-error">					
							<strong>Oh snap!</strong><br>Change a few things in you Email Address and try submitting again.						
						</div>
					</div>
					<a style="display:none;" class="emailsuccess modal-fancybox" href="#EmailSuccess">succsess</a>
					<div style="display:none;" id="EmailSuccess">
						<div class="alert alert-success">
							<strong>Thank You!</strong><br>Your Email was successfully saved, now you will receive information about Pufferfish Swimwear's Products and Promotions!. 						
						</div>
					</div>
					<div class="row">
						<div class="span4">
							<div class="row">
								<div class="span2">
									<h3>Quick Links:</h3>
									<ul class="footer-primary-menu">
										<li><a title="Size Chart" class="modal-fancybox" href="#size-chart">Size Chart</a></li>
										<li><a title="Blog" href="http://www.pufferfishswimwear.com/blog/">Blog</a></li>
									</ul>
								</div>
								<div class="span2">
									<h3>Customer Care:</h3>
									<ul class="footer-primary-menu">
										<li><a title="Contact Us" href="http://www.pufferfishswimwear.com/ContactUs.aspx">Contact Us</a></li>
									</ul>
									<h3>Company:</h3>
									<ul class="footer-primary-menu">
										<li><a title="About Us" href="http://www.pufferfishswimwear.com/AboutUs.aspx">About Us</a></li>
									</ul>
								</div>								
							</div>
						</div>
						<div class="span4">
							<div class="row">
								<div class="span4">
									<h3>Find Us On:</h3>
								</div>
							</div>
							<div class="row">
								<div class="span4">
									<ul class="footer-social-links">
										<li><a target="_blank" class="facebook" title="Facebook" href="https://www.facebook.com/PFSwimwear"></a></li>
										<li><a target="_blank" class="twitter" title="Twitter" href="https://twitter.com/PFSwimwear"></a></li>
										<li><a target="_blank" class="instagram" title="Instagram" href="http://instagram.com/pufferfishswimwear"></a></li>
										<li><a class="blog" title="Blog" href="http://www.pufferfishswimwear.com/blog/"></a></li>
										<li><a target="_blank" class="pinterest" title="Pinterest" href="http://www.pinterest.com/pfswimwear/"></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="span4">
							<div class="row">
								<div class="span4">
									<h3>Join our mailing list!</h3>
								</div>
							</div>
							<div class="row">
								<div class="span4">
									<div class="subscribe controls controls-row">
										<input type="text" onblur="if (this.value==''){this.value='Enter Your Email';}" onfocus="if (this.value=='Enter Your Email'){this.value='';}" value="Enter Your Email" class="email span3" name="txtEmail" id="txtEmail">
										<button onclick="return btnSubscribe_onclick()" class="span1 btn btn-block" type="button" id="footer_btnSubscribe">Join</button>										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="second-footer-menu-container">    	    
				<div class="row">
					<div class="span12">
						<div class="row visible-desktop visible-tablet">	                	
							<div class="span8">
								<p class="copyright">&copy; 2013 Pufferfish Swimwear, All Rights Reserved. Developed by <a title="DDEVCOM" target="_blank" href="http://www.ddevcom.com/">DDEVCOM</a></p>
							</div>
							<div class="span4">
								<ul class="footer-secondary-menu pull-right">
									<li><a title="Privacy Policy" href="http://www.pufferfishswimwear.com/PrivacyPolicy.aspx">Privacy Policy</a></li>
									<li><a title="Terms of Use" href="http://www.pufferfishswimwear.com/TermsOfUse.aspx">Terms of Use</a></li>
								</ul>
							</div>
						</div>
						<div class="row visible-phone">
							<div class="responsive-footer">
								<p class="copyright text-center">&copy; 2013 Pufferfish Swimwear, All Rights Reserved. Developed by <a title="DDEVCOM" target="_blank" href="http://www.ddevcom.com/">DDEVCOM</a></p>
								<ul class="footer-secondary-menu">
									<li><a title="Privacy Policy" href="http://www.pufferfishswimwear.com/PrivacyPolicy.aspx">Privacy Policy</a></li>
									<li><a title="Terms of Use" href="http://www.pufferfishswimwear.com/TermsOfUse.aspx">Terms of Use</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>    	    
			</div>
		</div>    
	</div>

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.pack.js"></script>	
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/pufferfish.js"></script>
	<script language="javascript" type="text/javascript">// 

	function saveEmailData(){
		var Email = document.getElementById('txtEmail').value;

		$.ajax({
            type: "POST",
            url: "http://www.pufferfishswimwear.com/Default.aspx/SaveEmail",
            data: "{Email:'"+Email+"'}",
            contentType: "application/json; charset=utf-8",
            success: function (msg) {
				//alert(msg.d);
			},
            failure: function (response) {
                alert(response.d);
            }
        });
	}

	function validateForm()
	{
		var x=document.getElementById('txtEmail').value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			//alert("Not a valid e-mail address");
			$(".emailfail").click();
			return false;
		}else{
			//alert("YES a valid e-mail address");
			saveEmailData();
			$(".emailsuccess").click();
			document.getElementById('txtEmail').value="Enter Your Email";
			return true;
		}
	}

	function btnSubscribe_onclick() {
		validateForm();
	}    

// ]]>
</script>
	<?php wp_footer(); ?>
</body>
</html>