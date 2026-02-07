<!DOCTYPE HTML>
<!--
	Solid State by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Tuned Mass Damper Simulation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Rakesh Kumar Ganji</a></h1>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<div class="inner">
							<h2>Menu</h2>
							<ul class="links">
								<li><a href="index.html">Home</a></li>								
							</ul>
							<a href="#" class="close">Close</a>
						</div>
					</nav>

				<!-- Wrapper -->
					<section id="wrapper">
						<header>
							<div class="inner">
								<h2>Tuned Mass Damper Simulation</h2>
								<p> Dynamic Modeling & Seismic Mitigation of a High-Rise Building with a Pendulum Tuned Mass Damper </p>
							</div>
						</header>

						<!-- Content -->
							<div class="wrapper">
								<div class="inner">

									<h3 class="major">Project Summary:</h3>
									<p><b>Objective:</b> To design, model, and simulate a Pendulum Tuned Mass Damper (PTMD)—analogous to the system in Taipei 101—and integrate it into a multi-story building model to evaluate its effectiveness in mitigating structural vibrations induced by seismic and wind loads.</p>

									<p><b>Core Challenge:</b> Develop a high-fidelity, multi-physics simulation that accurately captures the complex dynamic interaction between a 3D spatial pendulum damper and a flexible building structure with multiple vibrational modes, and to demonstrate significant reduction in structural response.</p>

									<p><b>Outcome: </b>Successfully built and simulated a complete Skycraper-PTMD system in Simscape Multibody and MATLAB/Simulink. The tuned damper achieved substantial reduction in displacement amplitudes (typically 40-60%) for the building's primary modes when subjected to resonant and broadband excitations, validating the design principles used in modern seismic and aerodynamic damping systems.</p>

									
									<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/BC and load.png" alt="First Image" width="900" height="400">
   									 
									</div><br>
									<i>Torque arm geometry with applied loads and boundary conditions (Fixed support on left bushing; axial and vertical traction on right bushing).</i></p>
									
									<h3 class="major">Methodology & Technical Execution:</h3>
									<b>1. Engineering Problem & Design Requirements:</b> <br>
									<b>•&nbspBase Design:</b> The torque arm is a load-bearing mechanical component that converts axial force into torque. It was subjected to a 4,500 N constant axial preload combined with a ±900 N vertical oscillating load. Key material properties: Aluminum alloy with Young’s Modulus (E) = 73.1 GPa, Poisson’s ratio (ν) = 0.33, Yield Strength (σ<sub>y</sub>) = 75 MPa, and Endurance Limit (σ<sub>e</sub>) = 30 MPa.<br>
									<b>•&nbspDomain Creation:</b> Initial design: Arm thickness = 6 mm, reinforced bushing regions = 8 mm.<br>
									
									


									<br><b>2. Finite Element Modeling in Abaqus:</b> 
									<p><b>Model Type:</b>A 2D Plane Stress simplification was validated, as the critical stress regions were confirmed to be away from 3D fillet areas.<br>
									<b>Geometry & Meshing:</b>The part was partitioned into two distinct sections—general arm and bushings—to assign separate thickness properties. A free-mesh strategy with CPS4R (4-node bilinear plane stress quadrilateral, reduced integration) elements was employed.<br>
									<b>Boundary Conditions & Loading:</b><br>
										&nbsp &nbsp •&nbsp<b>Left bushing:</b> Fully fixed (encastre boundary condition).<br>
										&nbsp &nbsp •&nbsp<b>Right bushing: </b> Loads applied as uniform surface traction over the inner hole surface to simulate pin contact, simplifying contact analysis while preserving accuracy in critical regions.<br>
									<b>Analysis Steps:</b>Two separate static steps were created: one for the steady preload and one for the peak alternating load.</p>

										<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/mesh.png" alt="First Image" width="900" height="400">
   									 
									</div><br>
									<i>Refined finite element mesh (6,961 CPS4R elements) highlighting partitioned sections and critical region refinement.</i></p>

									<b>3. Verification & Validation: Mesh Convergence Study:</b> <br>
									<b>Process: </b> A systematic mesh refinement study was conducted, increasing element count from 1,284 to 6,961 elements.<br>
									<b>Convergence Metric: </b>Monitored the stabilization of maximum principal stress at the critical location with each refinement.<br>
									<b>Result: </b>Achieved mesh independence, with stress variation below 2% between the final two meshes, confirming solution accuracy. The final mesh contained 6,961 CPS4R elements.</p>
									
									<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/mesh convergence.png" alt="First Image" width="900" height="700">
   									 
									</div><br>
									<i> Mesh convergence plot/table showing stabilization of maximum principal stress with increasing element count.</i></p>

									<b>4. Failure Analysis Methodology:</b> 
									<p>Two independent failure criteria were evaluated at the critical stress locations:<br>
									&nbsp &nbsp<b>•&nbspStatic Yield Check (Von Mises Criterion):</b> Combined the von Mises stress from the preload with the maximum principal stress from the alternating load at the same critical point.Verified that the resultant stress (4.041×10⁴ Pa) remained well below the material yield strength (75×10⁶ Pa).<br>
									&nbsp &nbsp<b>•&nbspFatigue Life Assessment (Gerber Criterion):</b> Applied the Gerber interaction formula for combined mean and alternating stresses:<br>
												
 													 (&sigma;<sub>cyc</sub> / &sigma;<sub>e</sub>) + 
  													(&sigma;<sub>mean</sub> / &sigma;<sub>y</sub>)<sup>2</sup> &le; 1
												<br>
										Where σ<sub>cyc</sub> = alternating stress amplitude (29.08 MPa) and σ<sub>mean</sub> = mean stress from preload (11.59 MPa). <br>
									MATLAB was used to compute the criterion and solve for the factor of safety (n<sub>s</sub>) using the derived equation:
													<br>
  														n<sub>s</sub> = &frac12; (&sigma;<sub>y</sub> / &sigma;<sub>m</sub>)<sup>2</sup> (&sigma;<sub>a</sub> / &sigma;<sub>e</sub>) 
 														 [-1 + &radic;(1 + (2&sigma;<sub>m</sub>&sigma;<sub>e</sub> / &sigma;<sub>y</sub>&sigma;<sub>a</sub>)<sup>2</sup>)]
													</p>

									<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/Max prinncipal stress(axial).png" alt="First Image" width="700" height="350">
   									 <img src="images/FEA/MAx principal (alternating).png" alt="Second Image" width="700" height="350">
									</div><br>
									<i> Max principle stress for preload and alternating loading conditions</i></p>	
									
									<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/reaction preload.png" alt=First Image width="700" height="350">
   									 <img src="images/FEA/reaction alternating.png" alt="Second Image" width="700" height="350">
									</div><br>
									<i> Reaction forces for preload and alternating loading conditions</i></p>									

									<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/vonMises stress.png" alt=First Image width="700" height="350">
   									
									</div><br>
									<i> VonMises Stress</i></p>


									<b>5. Design Optimization & Redesign:</b> Key results extracted included:<br> 
									&nbsp &nbsp•&nbspBased on initial failure analysis, target thicknesses were reduced to optimize material usage: Arm thickness: 5 mm, Bushing thickness: 6 mm.<br>
									&nbsp &nbsp•&nbspA new FEA model was built with these dimensions and re-analyzed.<br>
									&nbsp &nbsp•&nbsp<b>Validation:</b>The redesigned part passed both failure checks:<br>
									Gerber Criterion: 0.9997 (< 1.0, no fatigue failure)<br>
									Static Yield Check: Combined stress = 4.071×10⁴ Pa << Yield Strength<br>
									Factor of Safety (Fatigue): n<sub>s</sub> = 3,092</p>
									
										<div style="display: flex; gap: 10px;">
   									 <img src="images/FEA/Gerber criterion.png" alt=First Image width="800" height="700">
   									
									</div><br>
									<i> Gerber criterion</i></p>

									<h3 class="major">Key Findings & Results:</h3>

									<b>Results & Insights:</b>
									<p><b>1.&nbspCritical Stress Locations Identified:</b> Maximum stresses consistently occurred in the arm section near the material transition region, not at the load application points, validating the simplified load application and 2D modeling assumptions.<br>
									<b>2.&nbspSuccessful Lightweighting:</b> The redesign achieved a 17% reduction in arm thickness (6mm → 5mm) and 25% reduction in bushing thickness (8mm → 6mm) while maintaining a high safety factor.<br>
									<b>3.&nbspHigh Safety Factor:</b> Initial design: The exceptionally high factor of safety (3,092) indicates the part is significantly over-designed for the given loads, suggesting potential for further optimization in real-world applications where weight and cost are critical.<br>
									<b>4.&nbspReaction Force Validation:</b> Computed reaction forces at the fixed boundary matched the applied loads within 0.1%, confirming proper load application and equilibrium.</p>
									
									
									
									
									
									
									
									
									
									
									
									<b>Deliverables & Repository</b> <br>
									<p>The complete project documentation, including the detailed final report, Abaqus CAE models (.cae), journal files (.jnl), MATLAB scripts for fatigue analysis, and all simulation results are systematically maintained in a version-controlled repository.</p> 
									Repository Link: <a href="https://github.com/rakeshg16897/CFD-Analysis-on-an-undulated-wing"></a></p>