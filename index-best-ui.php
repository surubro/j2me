<?php
date_default_timezone_set("Asia/Kolkata");

$file = "chat.txt";

/* Disable cache */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

/* Save message */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim(strip_tags($_POST["user"] ?? ""));
    $msg  = trim(strip_tags($_POST["msg"] ?? ""));

    if ($user !== "" && $msg !== "") {
        $time = date("d M H:i");
        $line = "[$time] $user: $msg\n";
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Mini Chat</title>

<style>
body {
  font-family: Arial;
  background:#f2f2f2;
  font-size:12px;
  margin:0;
  padding:3px;
}

.box {
  background:#ffffff;
  border:1px solid #000;
  padding:3px;
  margin-bottom:5px;
}

input {
  font-size:12px;
  width:98%;
  margin-bottom:3px;
}

button, a.btn {
  font-size:12px;
  padding:3px 6px;
  background:#007bff;
  color:#fff;
  text-decoration:none;
  border:1px solid #000;
}

button {
  background:#28a745;
}
</style>
</head>

<body>

<div class="box">
<b>Chat Messages</b><br><br>
<?php
if (file_exists($file)) {
    $lines = file($file);
    foreach ($lines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
} else {
    echo "No messages yet<br>";
}
?>
</div>

<div class="box">
<form method="post">
Name:<br>
<input type="text" name="user"><br>
Message:<br>
<input type="text" name="msg"><br>

<table width="100%">
<tr>
<td><button type="submit">Send</button></td>
<td align="right"><a href="index.php" class="btn">Refresh</a></td>
</tr>
</table>
</form>
</div>

</body>
</html>