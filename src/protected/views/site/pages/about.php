<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is the Berkeley Yacht Club's Results site for Friday Night
	and Sunday Chowder races.  For more information about the race
	series, please visit <a href='http://www.berkeleyyc.org/racing'>our race page</a>.</p>

<h2>Using the site</h2>
<p>Everything should be pretty easy to find (if not, please 
	<a href="http://www.berkeleyyc.org/contact-us">let us know!</a>).  
	The first page is a list of all series we have in
	the system.  Each Chowder or Friday Night series is listed, with the most
	recent at the top.  Under each series, the race dates are listed (you may have
	to click on the series name to expand the list of races).  You may
	select a race date to view details about the race, including basic details
	like start time(s) and the full list of boats that competed.</p>

<h2>Entering new results</h2>
<p>If you would like to enter new race results, please <a href="http://www.berkeleyyc.org/contact-us">contact us</a> for login credentials.  Once you are able to <a href='<?php echo $this->createUrl('site/login'); ?>'>log in</a>, return to this page and you will see further instructions below this paragraph.</p>

<?php if (!Yii::app()->user->isGuest) { ?>
<h3>Instructions for Entering Races</h3>
<p>OK, you've logged into the site.  Now what?  Well, if you go back to the <a href='<?php echo $this->createUrl('site/index'); ?>'>list of series</a>, you will see some new links:</p>
<ul>
	<li>Above the list of series, there's an "Add a New Series" link.  Select it to
		enter a new series.  This should only be done twice per year - at the beginning
		of the Friday night series, and the Sunday Chowder series.</li>
	<li>Under each series, there's an "Add a Race" link.  Select that to begin entering a new race
		for that series.</li>
	<li>There is also an "Edit" link for each race.  Select it to correct mistakes,
		add boats, etc. for the race.</li>
</ul>

<h4>Series Info</h4>
<p>When adding a new series, you are asked for a few bits of information:</p>
<dl>
	<dt>Type</dt>
	<dd>Either Friday Nights or Sunday Chowders</dd>
	<dt>Name</dt>
	<dd>The name of the series.  This will be filled in automatically when you select
		the type, but you may edit it if you want (<em>not recommended!</em>)</dd>
	<dt>Default Method</dt>
	<dd>Select either "Time on Time", or "Time on Distance".
		As of this writing, Sunday Chowder are TOT and Friday Nights are TOD.
		For more details, see <a href="#calcs">TOT and TOD Calculations</a></dd>
	<dt>Default Param1 and Default Param2</dt>
	<dd>For TOT (Chowder) races, these are the numbers used in the TOT calculation (more <a href="#calcs">below</a>).
		Usually they are 800 and 550.  They aren't needed for TOD (Friday) races.</dd>
</dl>
<p>When these items are entered, select the Submit button.  You will be taken directly
	to the "Add a Race" page so you can, you know, add a race.  If you don't want to
	do that right away you can just return to the main page; the series you just entered
	is already saved.</p>

<h4>Basic Race Info</h4>
<p>Once you've selected the "Add a Race" or "Edit Race" links, you're taken to the basic info page
	for the race.  Things you can change are:</p>
<dl>
	<dt>Series</dt>
	<dd>A drop-down list of series.  You shouldn't need to change this.</dd>
	<dt>Date</dt>
	<dd>The date the race occurred.  Usually you'll be entering new races on the
		same day as the race, so this is filled in automatically with today's date
		for new races.</dd>
	<dt>RC Boat</dt>
	<dd>The name of the boat used for race committee.</dd>
	<dt>RC Skipper</dt>
	<dd>The name of the person(s) that did race committee.</dd>
	<dt>Prepared by</dt>
	<dd>Your name! Who says you're not famous?</dd>
	<dt>Method</dt>
	<dd>Select either "TOT" for time-on-time races, or "TOD" for time-on-distance races.
		As of this writing, Sunday Chowder are TOT and Friday Nights are TOD.
		For more details, see <a href="#calcs">TOT and TOD Calculations</a></dd>
	<dt>Parameter 1</dt>
	<dd>For TOT (Chowder) races, this is the numerator in the TOT calculation (more <a href="#calcs">below</a>).
		Usually it's 800.  It's not needed for TOD (Friday) races.</dd>
	<dt>Parameter 2</dt>
	<dd>For TOT (Chowder) races, this is the denominator in the TOT calculation (more <a href="#calcs">below</a>).
		Usually it's 550.  It's not needed for TOD (Friday) races.</dd>
</dl>
<p>When all the basic information is entered, select the Next button to move on 
	to entering boats' finish times.</p>

<h4>Entering Boats and Finish Times</h4>
<p>The list of boats entered so far in the race will be displayed next, in order of
	corrected finish time.  For new races, of course, initially there will be no boats
	listed.  To add boats, select a sail number or boat name first.  The PHRF will
	be filled in automatically from our roster, and the roller furling checkbox will
	be selected if the boat is registered as having a roller furler.  Fill in the
	finish time, select the spinnaker checkbox if the boat used a spinnaker, and make
	corrections to the PHRF and roller furler if necessary.  Once everything is filled in
	and you click away from the finish time, the corrected time and other fields will
	be calculated and displayed so you can preview the result.  If everything looks
	okay, select the Add button and the boat will be entered in the database.</p>
<p>Note on finish time format:  To save effort, the boat's finish time can be entered
	with or without colons separating the hours, minutes, and seconds fields.  So
	if a boat finishes at, say, 2:04:37 pm (in a Chowder race), the finish time can
	be entered either as:<p>
<p><code>140437</code></p>
<p>or</p>
<p><code>14:04:37</code></p>
<p>Also, if the finish time is entered incorrectly or any other required information
	is not provided, the corrected time will not display and the Add button will be
	grayed out.  Check your entered information for errors.</p>


<h3>TOT and TOD Calculations</h3>
<p>Here's how time-on-time (TOT) and time-on-distance (TOD) calculations work:</p>
<p><b>TOT (time-on-time)</b>:  The elapsed time for each boat is multiplied by a 
	Time Correction Factor (TCF) based on the boat's PHRF.  The equation is:</p>
<p><code>Corrected Time = Elapsed Time * TCF</code></p>
<p>The TCF is calculated by the formula:</p>
<p><code>TCF = A/(B + PHRF)</code></p>
<p>The A and B contants are in the sailing instructions, and are selected so that
	the TCF comes out close to 1.0 for the PHRFs of the expected competitors.  
	As of this writing, A = 800 and B = 550 for the Sunday Chowders.</p>
<p>Before calculating the corrected time, the TCF is further adjusted by
	subtracting 4% for the non-spinnaker credit, and 2% for the roller furling
	credit.</p>

<p><b>TOD (time-on-distance)</b>:  The elapsed time for each boat is adjusted
	by a factor related to the distance of the course and the boat's PHRF.
	The equation is:</p>
<p><code>Corrected Time = Elapsed Time - (distance * PHRF)</code></p>
<p>Before applying this formula, when appropriate 18 seconds/mile is added to the PHRF for
	the non-spinnaker credit and 12 seconds/mile is added for the roller furling
	credit.</p>


<?php } ?>
