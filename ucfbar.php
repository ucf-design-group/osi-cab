<link href="http://ucf.edu/css/header_bar.css" rel="stylesheet" type="text/css" media="screen" />
<div id="ucf4_header">
	<div class="wrapper">
		<h1>
			<a href="/">
			<span class="text">University of Central Florida</span>
			</a>
		</h1>
		<label for="UCFHeaderLinks">University Links</label>
		<label for="q">Search UCF</label>
		<div id="ucf4_search_and_links">	
			<form id="ucf4_uni_links" action="" target="_top">
				<fieldset>
				  	<select name="UniversityLinks" id="UCFHeaderLinks" onchange="window.location.href= this.form.UniversityLinks.options[this.form.UniversityLinks.selectedIndex].value">
					<option value="">Quicklinks:</option>
						
					<option value="">- - - - - - - - - -</option>
	
					<option value="http://library.ucf.edu">Libraries</option>
					<option value="http://www.ucf.edu/directories/">Directories (A-Z Index)</option>
					<option value="http://map.ucf.edu">Campus Map</option>
					<option value="http://ucffoundation.org">Giving to UCF</option>
					<option value="http://ucf.custhelp.com">Ask UCF</option>
					<option value="http://finaid.ucf.edu/">Financial Aid</option>
					<option value="http://www.ucf.edu/today">UCF Today</option>
					<option value="https://www.secure.net.ucf.edu/knightsmail/">Knight's Email</option>
					<option value="http://events.ucf.edu">Events at UCF</option>
			        <option id="UCFHeaderLinksStaticDivider" value="">- - - - - - - - - -</option>
					</select>
				</fieldset>
			</form>
			<div>
				<a id="ucf4_my_ucf" href="https://my.ucf.edu/?promo_id=myUCF"><span class="text">myUCF</span></a>
			</div>
			<form id="ucf4_search_ucf" method="get" onSubmit="_gaq.push(['_trackEvent','Main_site','Search_University_Header',jQuery('#q').val()]);" action="http://google.cc.ucf.edu/search" target="_top">
				<fieldset> 
					<input type="hidden" name="output" value="xml_no_dtd"/>
					<input type="hidden" name="proxystylesheet" value="UCF_Main"/>
					<input type="hidden" name="client" value="UCF_Main"/>
					<input type="hidden" name="site" value="UCF_Main"/>
					<input class="text" type="text" name="q" id="q" value="Search UCF" /> 
					<input class="submit" type="image" alt="Search button" src="http://www.ucf.edu/img/arrow.png" />
				</fieldset>
			</form>
			<div id="ucf4_search_and_links_end"></div>
		</div>
	</div>
</div>