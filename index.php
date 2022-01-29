<?php
$question = $_POST["question"];
$msg = "سوال خود را بپرسید!";

$arr_1=file_get_contents("people.json");
$arr_2= json_decode($arr_1, true);
$en_name = 'hafez';
$fa_name = 'حافظ';
if($_POST["person"]){
	$en_name= $_POST["person"];
	$fa_name= $arr_2[$en_name];
	$question= $_POST["question"];
	$myfile= file("messages.txt");
	$sakht_hash= hash('md5', "$en_name" . "$question");
	$msg= $myfile[$sakht_hash%count($myfile)];
}
else{
		$en_name=array_rand($arr_2);
		$fa_name=$arr_2[$en_name];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
				array_flip();
                <?php
				foreach($arr_2 as $name => $firstname){
					if($name==$en_name){
						 echo '<option value='."$name".' selected>'."$firstname".'</option>';
					}
					else{
						 echo '<option value='."$name".'>'."$firstname".'</option>';
					}
				}
				
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>