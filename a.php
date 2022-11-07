<?php
function TestInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function addNumber($num,$dir)
{
    file_put_contents($dir, $num ."\n", $flags = FILE_APPEND);
    echo "این شماره ثبت شد";
}

if (filter_has_var(INPUT_POST, 'mobile') && preg_match('/^09[0-9]{9}$/', $_POST['mobile'])) {
    $mobile = TestInput($_POST['mobile']);
    $filename = "list-number.txt";

    if(is_file($filename) == false)
    {
        $file = fopen($filename,"w");
        addNumber($mobile,$filename);
    }
    else
    {
        $file = fopen($filename,"r");
        if(filesize($filename) > 0) {
            $a = fread($file, filesize($filename));
            if (strpos($a, $mobile) !== false)
                echo "این شماره قبلا ثبت شده است.";
            else
                addNumber($mobile,$filename);
        }
        else
            addNumber($mobile,$filename);

        fclose($file);
    }

}
else
    echo "شماره موبایل به درستی وارد کنید";
?>