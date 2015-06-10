<?php
/**
 * 404 ( Not found page )
 */
get_header(); ?>
	<div id="blog">
		<div class="main-container col1-layout">
			<div class="main">				
				<div class="col-main">
					<div class="std">
						<div class="halfpage">
							<div class="page-title txt_center"><h1>Whoops, our bad...</h1></div>
							<div class="txt_center noticon">
								<p><img border="0" alt="The page you requested was not found" src="http://www.camilaswimwear.com/media/wysiwyg/icons/cam-icon-nopage.png"></p>
							</div>
							<dl>
								<dt>The page you requested was not found, and we have a fine guess why.</dt>
								<dd>
									<ul class="disc">
										<li>If you typed the URL directly, please make sure the spelling is correct.</li>
										<li>If you clicked on a link to get here, the link is outdated.</li>
									</ul>
								</dd>
							</dl>
							<dl>
								<dt>What can you do?</dt>
								<dd>Have no fear, help is near! There are many ways you can get back on track with Camila Swimwear Blog.</dd>
								<dd>
									<ul class="disc">
										<li><a onclick="history.go(-1); return false;" href="#">Go back</a> to the previous page.</li>
										<li>Use the search bar at the top of the page to search in blog.</li>										
									</ul>
								</dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>