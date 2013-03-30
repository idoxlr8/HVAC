<?
/*/////////////////////////////////////////////////////////////////////////////////////////
Created by: Mr_density

Description:
A simple random image generator.
I wrote this script because i had some trouble with other similar scripts that didn't work
as well as this one.

Instructions:
1. Just put this script in the directory containing your images and connect via a
browser to this script. The script wil only show images (jpg, gif, png) not other
file formats.

2. Via an html image tag your can call the script on your site.
syntax: <img src="randompic.php"> or <img src="randompic.php?tnsize=48"> (to resize).

Change $config["systempath"] to the path where the images are stored (not the URL and no slash on the end). 
Change $config["webpath"] to the path where the images can be found through a webbrowser (include a ending slash).

The options for $config["type"] are "redirect" and "readfile". Redirect will use a "location" header wich will display the image (kind of redirect so). Readfile will read the file from the local hardrive and directly displayed (actually I can not recommend that).
////////////////////////////////////////////////////////////////////////////////////////*/
$config["systempath"]	= "";
$config["webpath"]		= "";
$config["type"]			= "redirect";

if($config["systempath"] != "")
{
    $dircheck = $config["systempath"];
    if (is_dir($dircheck)) //check if it is a valid systempath
    {
		$pathtoread = $config["systempath"];
	}
	else
	{
		 // If not, it creates an error image and displays it
		 $img = imagecreate(150, 150);
		 $red = imagecolorallocate($img, 255, 0, 0);
		 $yellow = imagecolorallocate($img, 255,255, 0);
		 imagestring($img, 4, 20, 20, "System", $yellow);
		 imagestring($img, 4, 20, 40, "path", $yellow);
		 imagestring($img, 4, 20, 60, "error!", $yellow);
		 imagepng($img);
		 imagedestroy($img);
		 exit();	
	}
}
else
{
	$pathtoread = "."; //Dir where this file is stored
}
if($config["webpath"] != "")
{
	$url = $config["webpath"];
}
else
{
	$explode = explode("/",$_SERVER["REQUEST_URI"]);
	$url = "http://".$_SERVER["SERVER_NAME"]."/";
	for($i=0;$i<(count($explode)-1);$i++)
	{
		$url.=$explode[$i]."/";
	}
}

$imgdir = opendir($pathtoread); 
while($file = readdir($imgdir))
{     
	$images[count($images)] = $file; //search all files
} 
closedir ($imgdir); 

// Removes all non-image files
$tempvar = 0;
for ($i = 0; $images[$i]; $i++)
{
	$ext = strtolower(substr($images[$i],-4));
	if ($ext == ".jpg" || $ext == ".gif" || $ext == "jpeg" || $ext== ".png" )
	{
		$images1[$tempvar] = $images[$i];

	//here

		$tempvar++;
	}
}

//Get a random image
$randomnr = rand(0, count($images1)-1);
$img = $images1[$randomnr];

//To resize a image
if(isset($tnsize))
{
	$tnsize = (integer) $tnsize;
	if (($tnsize < 20) || ($tnsize > 300))
	{
		 // If not, it creates an error image and displays it
		 $img = imagecreate(150, 150);
		 $red = imagecolorallocate($img, 255, 0, 0);
		 $yellow = imagecolorallocate($img, 255,255, 0);
		 imagestring($img, 4, 20, 20, "Afmetingen", $yellow);
		 imagestring($img, 4, 20, 40, "kloppen", $yellow);
		 imagestring($img, 4, 20, 60, "niet!", $yellow);
		 imagepng($img);
		 imagedestroy($img);
		 exit();
	}
	
	if ($ext == ".jpg" || $ext == "jpeg")
	{
		$bigimage = @imagecreatefromjpeg($img);
	}
	if ($ext == ".gif")
	{
		$bigimage = @imagecreatefromgif($img);
	}
	if ($ext == ".png" || $ext == "jpeg")
	{
		$bigimage = @imagecreatefrompng($img);
	}

	//Create an empty image of the given size
	$tnimage = imagecreate($tnsize, $tnsize);
	$darkblue = imagecolorallocate($tnimage, 0,0, 127);
	imagecolortransparent($tnimage,$darkblue);
	
	//Calculate the resizing image factor
	$sz = getimagesize($img);
	$x = $sz[0];
	$y = $sz[1];
	if ($x > $y) 
	{
		 $dx = 0;
		 $w = $tnsize;
		 $h = ($y / $x) * $tnsize;
		 $dy = ($tnsize - $h) / 2;
	}
	else
	{
		 $dy = 0;  
		 $h = $tnsize;
		 $w = ($x / $y) * $tnsize;
		 $dx = ($tnsize - $w) / 2;
	}

	// Resizes the image
	imagecopyresized($tnimage, $bigimage, $dx, $dy, 0, 0, $w, $h,$x, $y);
	
	// Displays the image
	imagepng($tnimage);

	// Clears the variables
	imagedestroy($tnimage);
	imagedestroy($bigimage);
}
else
{
	if($config["type"]=="redirect"){
		header("Location: ".$url.$img);
	}
	else if($config["type"]=="readfile"){
		readfile($pathtoread."/".$img);
	}
	else
	{
		echo "Error: unknown displaytype";
	}
}
?>