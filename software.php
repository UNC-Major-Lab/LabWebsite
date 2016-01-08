<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include "header.html" ?>
	<title>Major Lab - Software</title>
	<script type="text/javascript" src="js/google-analytics.js"></script>
</head>
<body>
	<div id="wrap">
		<?php include "navbar.html";?>
      
		<div id="stripe2">
	
			<div id="str2">
				<div class="innerdiv">
					<div class="pageHeader">
						<h1>Software</h1>
					</div>
					<div class="content">
						<!-- spotlite -->
						<div class="software-content">
							<div class="software-container spotlite" onclick="window.open('https://lbgsites2.bioinf.unc.edu/spotlite','new_window');"  style="cursor: pointer;">
								<div class="software-img">
									<img src="img/spotlite_software.png" alt="Spotlite"/>
								</div>
								<div class="software-desc">
									<p class="software-title">Spotlite: A web server for predicting co-complexed proteins from affinity purification – mass spectrometry data
									</p>
									<p>
										Spotlite is a user-friendly web application for predicting complex co-membership from affinity purification - mass spectrometry data. This web application employs a logistic regression classifier that integrates existing, proven APMS scoring approaches (SAINT, CompPASS, and HGSCore), gene co-expression patterns, functional annotations, domain-domain binding affinity, and homologous interactions, which we have shown outperforms existing APMS scoring methods. Spotlite can be access <a href="https://lbgsites2.bioinf.unc.edu/spotlite" target="_blank">here</a>. 
									</p>
								</div>
								<!--<div style="clear:both"/>-->
							</div>
						
							<!-- MSAcquisitionSimulator -->
							<div class="software-container MSAcquisitionSimulator" onclick="window.open('https://github.com/DennisGoldfarb/MSAcquisitionSimulator/','new_window');"  style="cursor: pointer;">
								<div class="software-img">
									<img src="img/MSAcquisitionSimulator_software.png" alt="MSAcquisitionSimulator"/>
								</div>
								<div class="software-desc">
									<p class="software-title">MSAcquisitionSimulator: data-dependent acquisition simulator for LC-MS shotgun proteomics
									</p>
									<p>
										MSAcquisitionSimulator is a collection of three command-line tools written in C++ that simulate ground truth LC-MS data and the subsequent application of custom data-dependent acquisition (DDA) algorithms. It provides an opportunity for researchers to test, refine, and evaluate novel DDA algorithms prior to implementation on a mass spectrometer. The project and source code is hosted on <a href="https://github.com/DennisGoldfarb/MSAcquisitionSimulator/" target="_blank">GitHub</a>. 
									</p>
								</div>
								<!--<div style="clear:both"/>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.html"?>
</body>
</html>
