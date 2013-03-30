<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--
	// 
	// Copyright (c) 2008 Beau D. Scott | http://www.beauscott.com
	// 
	// Permission is hereby granted, free of charge, to any person
	// obtaining a copy of this software and associated documentation
	// files (the "Software"), to deal in the Software without
	// restriction, including without limitation the rights to use,
	// copy, modify, merge, publish, distribute, sublicense, and/or sell
	// copies of the Software, and to permit persons to whom the
	// Software is furnished to do so, subject to the following
	// conditions:
	// 
	// The above copyright notice and this permission notice shall be
	// included in all copies or substantial portions of the Software.
	// 
	// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
	// OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
	// HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
	// WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	// FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
	// OTHER DEALINGS IN THE SOFTWARE.
	// 
-->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script type="text/javascript" src="../lib/prototype/prototype.js"></script>
		<script type="text/javascript" src="../lib/scriptaculous/scriptaculous.js"></script>
		<script type="text/javascript" src="../src/HelpBalloon.js"></script>
		<title>HelpBalloon.js 2.0 Examples</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css"></link>
		<script type="text/javascript">
		<!--
		//
		// Override the default settings to point to the parent directory
		//
		HelpBalloon.Options.prototype = Object.extend(HelpBalloon.Options.prototype, {
			icon: '../images/icon.gif',
			button: '../images/button.png',
			balloonPrefix: '../images/balloon-'
		});
		
		//-->
		</script>
	</head>
	<body>
		<div id="header">
			<div style="float: right"><a href="http://www.beauscott.com">BeauScott.com</a></div>
			<h1>HelpBalloon.js 2.0.1 Examples</h1>
		</div>
		<br/>
		<div id="content">
			<div style="text-align: center">
				<a href="advanced_examples.php">Advanced Usage Examples</a> | <a href="imagemap.htm">Image Map Example</a> | <a href="api.xml">API documention</a>
			</div>
			<table>
				<tr>
					<td style="width: 50%">

<!-- Static Balloon -->				
<?php 

$code = <<<CODE
<script type="text/javascript">
	var hb1 = new HelpBalloon({
		title: 'Non-Ajax Balloon',
		content: 'This is an example of static '
			+ 'balloon content.',
		autoHideTimeout: 2000
	});
</script>
CODE;

?>
<div class="example">
	<div class="left"><?=$code;?></div>
	<h2>Non-Ajax Balloon</h2>
	<br style="clear: both"/>
	<p>
	This example illustrates how to populate a balloon's content using the object's properties
	</p>
	<code style="white-space:pre"><?=htmlspecialchars($code);?></code>
</div>

<!-- Second Static Balloon -->
<?php
$code = <<<CODE
<script type="text/javascript">
	var hb3 = new HelpBalloon({
		title: 'Non-Ajax Balloon',
		content: 'This is an example of static '
			+ 'balloon content.'
	});
</script>
CODE;
?>
<div class="example">
	<div class="left"><?=$code; ?></div>
	<h2>Another Static Balloon</h2>
	<br style="clear: both"/>
	This balloon and the balloon above are identical. The reason I put this one here is so you can see the balloons ability to
	automatically choose it's position based on available realestate.
	<code style="white-space:pre"><?=htmlspecialchars($code);?></code>
</div>

<!-- External Controls -->
<?php
$code = <<<CODE
<script type="text/javascript">
	var hb5 = new HelpBalloon({
		title: 'Non-Ajax Balloon',
		content: 'This is an example of static '
			+ 'balloon content.'
	});
</script>
CODE;
$code2 = <<<CODE
<button id="btnShow" onclick="hb5.show();">Show</button>
<!-- Prototype Event.observe method -->
<button id="btnHide">Hide</button>
<script type="text/javascript">
	Event.observe('btnHide', 'click', hb5.hide.bind(hb5));
</script>
CODE;
?>
<div class="example">
	<div class="left"><?=$code;?></div>
	<h2>Toggling Balloons Externally</h2>
	<br style="clear: both"/>
	Use the show and hide methods to toggle the balloons externally:
	<?=$code2;?>
	<code style="white-space:pre"><?=htmlspecialchars($code."\n".$code2);?></code>
</div>


<!-- Other objects as anchors -->
<?php
$code = <<<CODE
<a href="#" id="mynewanchor" onclick="return false;">this</a> will be 
my new anchor for this example. Notice there is no icon displayed.
<script type="text/javascript">
	new HelpBalloon({
		title: 'Mouseover Balloon',
		content: 'This is an example of static '
			+ 'balloon content.',
		icon: $('mynewanchor')
	});
</script>
CODE;
?>
<div class="example">
	<h2>Using another object as the balloon's anchor</h2>
	<br style="clear: both"/>
	If you'd like to use something other than an image as the balloon's anchor, you can
	set the icon instantiation option to the element you want to use.
	<p>
		For example:  
		<?=$code; ?>						
	</p>
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>
				
<!-- Other Events -->
<?php
$code = <<<CODE
<script type="text/javascript">
	new HelpBalloon({
		title: 'Mouseover Balloon',
		content: 'This balloon was shown using '
			+ 'the mouseover event.',
		useEvent: ['mouseover']
	});
</script>
CODE;
?>
<div class="example">
	<div class="left"><?=$code;?></div>
	<h2>Using other events to trigger the balloon</h2>
	<br style="clear: both"/>
	If you'd like to use a different event to trigger the balloon's appearing
	use the <span class="code">useEvent</span> initialization parameter. This parameter is
	an array of strings so you can use multiple event types to trigger the
	balloon.
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>

<!-- Other Icons #2 -->
<?php
$code = <<<CODE
Default:
<script type="text/javascript">
	new HelpBalloon({
		title: 'Default Anchor',
		content: 'You can set the position of the anchor '
			+ 'using the \'anchorPosition\' option. Possible '
			+ 'values are top, middle, bottom, left center and right '
			+ 'and any numeric value. It reads it as \'X Y\'',
		icon: 'assets/quadrants.gif',
		iconStyle: {
			'cursor': 'pointer',
			'verticalAlign': 'middle'
		}
	});
</script>
Custom:
<script type="text/javascript">
	new HelpBalloon({
		title: 'Custom Anchor',
		content: 'You can set the position of the anchor '
			+ 'using the \'anchorPosition\' option. Possible '
			+ 'values are top, middle, bottom, left center and right '
			+ 'and any numeric value. It reads it as \'X Y\'',
		icon: 'assets/quadrants.gif',
		anchorPosition: '37 12',
		iconStyle: {
			'cursor': 'pointer',
			'verticalAlign': 'middle'
		}
	});
</script>
Custom 2:
<script type="text/javascript">
	new HelpBalloon({
		title: 'Custom Anchor',
		content: 'You can set the position of the anchor '
			+ 'using the \'anchorPosition\' option. Possible '
			+ 'values are top, middle, bottom, left center and right '
			+ 'and any numeric value. It reads it as \'X Y\'',
		icon: 'assets/quadrants.gif',
		anchorPosition: 'bottom right',
		iconStyle: {
			'cursor': 'pointer',
			'verticalAlign': 'middle'
		}
	});
</script>
Custom 3:
<script type="text/javascript">
	new HelpBalloon({
		title: 'Custom Anchor',
		content: 'You can set the position of the anchor '
			+ 'using the \'anchorPosition\' option. Possible '
			+ 'values are top, middle, bottom, left center and right '
			+ 'and any numeric value. It reads it as \'X Y\'',
		icon: 'assets/quadrants.gif',
		anchorPosition: 'right 37',
		iconStyle: {
			'cursor': 'pointer',
			'verticalAlign': 'middle'
		}
	});
</script>
CODE;
?>
<div class="example">
	<h2>Anchor Positioning Example</h2>
	<p>
		Sometimes when using custom icons you want the anchor point to appear in a different location in relation to the icon.
		By using the <span class="code">anchorPosition</span> initialization option, you can specify an x/y cooridinate within the icon, or
		use general instruction like '<span class="code">top</span>', '<span class="code">middle</span>', '<span class="code">bottom</span>', '<span class="code">left</span>', 
		'<span class="code">center</span>', and '<span class="code">right</span>'. When specifiying a numeric x or
		y cooridinate, the first instruction is the <span class="code">x</span> value, and the second is the <span class="code">y</span>. 
		Default is <span class="code">'center middle'</span>.
	</p>
	<br/>
	<div style="vertical-align: middle; text-align: center;"><br/>
		<?=$code;?><br/>&nbsp;
	</div>
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>
	
				</td>
				<td style="width: 50%">

<!-- XML balloon -->
<?php
$code = <<<CODE
<script type="text/javascript">
	var hb2 = new HelpBalloon({
		dataURL: 'assets/test.xml'
	});
</script>
CODE;
?>
<div class="example">
	<div class="right"><?=$code;?></div>
	<h2>Using XML to populate a balloon.</h2>
	<br style="clear: both"/>
	This example illustrates how to populate a balloon's using and XML document (AJAX)
	<code style="white-space:pre"><?=htmlspecialchars($code);?></code>
</div>

<!-- HTML Balloon -->
<?php
$code = <<<CODE
<script type="text/javascript">
	var hb4 = new HelpBalloon({
		dataURL: 'assets/test.htm'
	});
</script>
CODE;
?>
<div class="example">
	<div class="right"><?=$code;?></div>
	<h2>Using HTML to populate a balloon.</h2>
	<br style="clear: both"/>
	This example illustrates how to populate a balloon's using a regular HTML page (AJAX)
	<code style="white-space:pre"><?=htmlspecialchars($code);?></code>
</div>

<!-- Non-Cached HTML Balloon -->
<?php
$code = <<<CODE
<script type="text/javascript">
	var hb4 = new HelpBalloon({
		dataURL: 'assets/test2.php',
		cacheRemoteContent: false
	});
</script>
CODE;
?>
<div class="example">
	<div class="right"><?=$code;?></div>
	<h2>Forcing a new Request on each showing</h2>
	<br style="clear: both"/>
	This example illustrates how to populate a balloon's using a regular HTML page, but forcing it to refresh before every showing.
	<code style="white-space:pre"><?=htmlspecialchars($code);?></code>
</div>

<!-- Appending thru javascript -->
<?php
$code = <<<CODE
<div style="float: right; margin: 20px;" id="myContainer"></div>
<script type="text/javascript">
	var hb6 = new HelpBalloon({
		returnElement: true,
		title: 'Non-Ajax Balloon',
		content: 'This is an example of static '
			+ 'balloon content.'
	});
	$('myContainer').appendChild(hb6.icon);
</script>
CODE;
?>
<div class="example">
	<?=$code;?>
	<h2>Manually Appending the Balloon Icon</h2>
	<br style="clear: both"/>
	In some instances the default behavior of creating the balloon element does not work (ajax-loads, etc), because
	the script depends on document.write to output the code for the icon. This is how you can still use balloons in that case:
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>

<!-- Other Icons #1 -->
<?php
$code = <<<CODE
<img src="http://us.i1.yimg.com/us.yimg.com/i/ww/beta/y3.gif" 
	id="yahoologo" border="0" />
<script type="text/javascript">
	new HelpBalloon({
		title: 'Yahoo!',
		content: 'This balloon was shown using the yahoo '
			+ 'logo as the icon.',
		icon: $('yahoologo')
	});
</script>
CODE;
?>
<div class="example">
	<h2>Using a different icon example #1</h2>
	<br style="clear:both;"/>
	If you'd like to reference an existing image in your page as the icon for the balloon:
	<?=$code;?>
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>

<!-- Other Icons #2 -->
<?php
$code = <<<CODE
<script type="text/javascript">
	new HelpBalloon({
		title: 'Amazon',
		content: 'This balloon was shown using the amazon '
			+ 'logo as the icon.',
		icon: 'http://g-ecx.images-amazon.com/images/G/01/gno'
			+ '/images/general/navAmazonLogoFooter._V28232323_.gif'
	});
</script>
CODE;
?>
<div class="example">
	<h2>Using a different icon example #2</h2>
	If you'd just like to use a different image as your icon, and not one that already exists:
	<?=$code;?>
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>

<!-- Other Icons #2 -->
<?php
$code = <<<CODE
Default:
<script type="text/javascript">
	new HelpBalloon({
		title: 'Default Direction',
		content: 'This balloon is positioned dynamically.'
			+ '<br/>HelpBalloon.POS_DYNAMIC<br/>'
			+ 'In this mode, it will position itself based '
			+ 'on available document realestate.'
	});
</script><br/>
Position 0 (Top-Left):
<script type="text/javascript">
	new HelpBalloon({
		title: 'Direction 0',
		content: 'This balloon is in position 0.'
			+ '<br/>HelpBalloon.POS_TOP_LEFT',
		fixedPosition: HelpBalloon.POS_TOP_LEFT // 0
	});
</script><br/>
Position 1 (Top-Right):
<script type="text/javascript">
	new HelpBalloon({
		title: 'Direction 1',
		content: 'This balloon is in position 1.'
			+ '<br/>HelpBalloon.POS_TOP_RIGHT',
		fixedPosition: HelpBalloon.POS_TOP_RIGHT // 1
	});
</script><br/>
Position 2 (Bottom-Right):
<script type="text/javascript">
	new HelpBalloon({
		title: 'Direction 2',
		content: 'This balloon is in position 2.'
			+ '<br/>HelpBalloon.POS_BOTTOM_RIGHT',
		fixedPosition: HelpBalloon.POS_BOTTOM_RIGHT // 2
	});
</script><br/>
Position 3 (Bottom-Left):
<script type="text/javascript">
	new HelpBalloon({
		title: 'Direction 3',
		content: 'This balloon is in position 3.'
			+ '<br/>HelpBalloon.POS_BOTTOM_LEFT',
		fixedPosition: HelpBalloon.POS_BOTTOM_LEFT // 3
	});
</script>
CODE;
?>
<div class="example">
	<h2>Fixed Anchor Direction Example</h2>
	<p>
		By default, the balloon will orient itself automatically based on available realestate in the document.
		If you don't want this behavior, you can assign a fixed direction to the balloon using the
		<span class="code">fixedPosition</span>.
	</p>
	<br/>
	<div>
		<?=$code;?><br/>&nbsp;
	</div>
	<code style="white-space: pre;"><?=htmlspecialchars($code); ?></code>
</div>

					</td>
				</tr>
			</table>
		</div>				
		<div id="copyright">Copyright &#169; 2008 Beau D. Scott. All Rights Reserved. <a href="http://www.beauscott.com/">BeauScott.com</a><br/>
			Licensed under MIT-style terms
			<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
			</script>
			<script type="text/javascript">
			_uacct = "UA-524142-2";
			urchinTracker();
			</script>
		</div>
	</body>
</html>