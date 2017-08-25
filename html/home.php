<html>

<!--- This is a admin file where they can view data and do admin stuff -->

<div align="center">
<tile>Welcome to the site</title>
</div>

<!--- Changes text color to red -->

<div align ="center">
    <font color="red">
Hello World, This is test for website!!
</div >

<!--- Create a button so admin can view data , when user submit the button it give the button info to view.php file-->
<div align ="left">
<form action="view.php" method="post">
<p>View Client:<input id="submit" type="submit" name='client' value="client"> </p>
<p>View ClientContact:<input id="submit" type="submit" name='client' value="client contact"></p>
<p>View Order that are due today:<input id="submit" type="submit" name='client' value="order due today"></p>
<p>View Order:<input id="submit" type="submit" name='client' value="view order"></p>
<p>View Invoice:<input id="submit" type="submit" name='client' value="view invoice"></p>
</form>
</div>

<!---  Create the  Logout out button and it redirect to main page-->
<div align="right">
<form action="index.html">
<input type="submit" value ="Log out">
</form>
</div>


</html>
