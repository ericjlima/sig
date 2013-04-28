<?php
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include_once("scripts/checkuserlog.php");
// Include the class files for auto making links out of full URLs and for Time Ago date formatting
include_once("wi_class_files/autoMakeLinks.php");
include_once ("wi_class_files/agoTimeFormat.php");
// Create the two objects before we can use them below in this script
$activeLinkObject = new autoActiveLink;
$myObject = new convertToAgo; 
?>
<?php
// Include this script for random member display on home page
include_once "scripts/homePage_randomMembers.php"; 
?>
<?php
$sql_sigs = mysql_query("SELECT * FROM sig ORDER BY sig_date DESC LIMIT 10");

$sigberDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sql_sigs)){
	
	$sigid = $row["id"];
	$uid = $row["mem_id"];
	$the_sig = $row["the_sig"];
	//$the_sig = substr($the_sig, 0, 48);
	$the_sig = wordwrap($the_sig, 30, "\n", true);
	//$the_sig = wordwrap($the_sig, 14, "<br />\n");
	$notokinarray = array("hacker", "goku", "superman", "powers", "smarts", "awesome", "courage", "slammed", "wisdom");
    $okinarray   = array("hacker", "goku", "superman", "powers", "smarts", "awesome", "courage", "slammed", "wisdom");
	$the_sig = str_replace($notokinarray, $okinarray, $the_sig);
	$the_sig = ($activeLinkObject -> makeActiveLink($the_sig));
	$sig_date = $row["sig_date"];
	$convertedTime = ($myObject -> convert_datetime($sig_date));
    $whensig = ($myObject -> makeAgo($convertedTime));
	$sig_type = $row["sig_type"];
	$sig_device = $row["device"];
	
	// Inner sql query
	$sql_mem_data = mysql_query("SELECT id, username, firstname, lastname FROM myMembers WHERE id='$uid' LIMIT 1");
	while($row = mysql_fetch_array($sql_mem_data)){
			$uid = $row["id"];
			$username = $row["username"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			if ($firstname != "") {$username = "$firstname $lastname"; } // (I added usernames late in  my system, this line is not needed for you)
			///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
			$ucheck_pic = "members/$uid/image01.jpg";
			$udefault_pic = "members/0/image01.jpg";
			if (file_exists($ucheck_pic)) {
			$sigber_pic = '<div style="overflow:hidden; width:40px; height:40px;"><img src="' . $ucheck_pic . '" width="40px" border="0" /></div>'; // forces picture to be 100px wide and no more
			} else {
			$sigber_pic = "<img src=\"$udefault_pic\" width=\"40px\" height=\"40px\" border=\"0\" />"; // forces default picture to be 100px wide and no more
			}
	
			$sigberDisplayList .= '
      			<table width="100%" align="center" cellpadding="4" style="background-color:#CCCCCC; border:#999 1px solid;">
        <tr>
          <td width="7%" bgcolor="#FFFFFF" valign="top"><a href="signal_page.php?id=' . $uid . '">' . $sigber_pic . '</a>
          </td>
          <td width="93%" bgcolor="#F9F9F9" style="line-height:1.5em;" valign="top">
		 <span class="liteGreyColor textsize9"> ' . $whensig . ' <a href="signal_page.php?id=' . $uid . '"><strong>' . $username . '</strong></a> <br />
          via <em>' . $sig_device . '</em></span><br />
         <span class="textsize10"> ' . $the_sig . '</span>
            </td>
        </tr>
      </table>';
			}
	
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="" />
<meta name="Keywords" content="" />
<title>Sigternet - Revision of the internet</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript"> 
function toggleSlideBox(x) {
		if ($('#'+x).is(":hidden")) {
			//$(".sourceBox").slideUp(200);
			$('#'+x).slideDown(300);
		} else {
			$('#'+x).slideUp(300);
		}
}
</script>
</head>
<body>
<?php include_once "header_template.php"; ?>

<table width="920" style="background-color:#F2F2F2;" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>

    <td width="920" valign="top">
<div class="textsize16 greenColor" style="border:#999 1px solid; width:728px; border-top:none; border-bottom:none;"><!---img src="images/sigternet_2.jpg" width="728" height="152" alt="Sigternet" /---></div>

<div id="sb1" style="display:none; width:704px; border:#999 1px solid; padding:12px; background-image:url(style/area1BG.jpg); line-height:1.5em; ">Sigternet will revision the internet.<br />
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;">
  <tr>
      <td width="34%"><strong>&bull; Registration System</strong><span class="textsize10"> (php  mysql)</span><strong><br />
        &bull; Activation System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
        &bull; Login w/ keep log System</strong> <span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; Friend System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Private Message System </strong><span class="textsize10">(php  mysql)</span><strong><br />
&bull; API and Gadget Systems </strong><span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; signal_page EditingSystem</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Member Listing System </strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull;Status System</strong> <span class="textsize10">(php  mysql)</span></td>
    </tr>
</table>
</div>
<div style="width:900px; border:#999 1px solid; border-bottom:none;"></div>
<table style="background-color:#EFEFEF; border:#999 thin solid; padding:10px; line-height:1.5em;" width="900" border="0" cellspacing="0" cellpadding="8">
  <tr>
      <td width="100%" valign="top">
      
        <strong>This Site was Made Using PHP and MySQL</strong><br />
        &bull;&nbsp;<a href="http://www.erictheprogrammer.com/" target="_blank">1. Check out my personal website www.erictheprogrammer.com for more info about Eric Lima.</a><br />
		&bull;&nbsp;<a href="http://www.sig.erictheprogrammer.com/about.php" target="_blank">2. Check out about for more info.</a><br />
        <br />
		      <div style="font-size:15px; margin-bottom:5px;"><strong><center>Latest Signal Pages:<center/></strong></div>        
        <?php  print "$MemberDisplayList"; ?><br />
         <div style="font-size:15px; margin-bottom:5px;"><strong>Latest Signals:</strong></div>
         <div style="width:900px; overflow:hidden; border: #999 thin solid;"> <?php echo "$sigberDisplayList"; ?></div>
         
    </tr>
	<br />
        </td>
  </table></td> 
    <td width="188" valign="top"><br /><br /><br />
<a href="http://www.sig.erictheprogrammer.com" target="_blank"><center></center></a></td> 
  </tr>

</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>