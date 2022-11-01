<?php
include "contDb.php";

class AboutController
{
    function index()
    {
        global $cont;
        $about = $cont->prepare("SELECT * FROM `abouts`");
        $about->execute([]);

        return $about;
    }

    function update($request)
    {
        global $cont;
        $about = $cont->prepare("UPDATE `abouts` SET `name`=?,`title`=?,`desc`=?,`from`=?,`live_in`=?,`age`=?,`gender`=?,`image`=? WHERE id =?");
        if($about->execute($request)){

            $_SESSION['done'] = "About Was Updated";
            //header("Location:../About/aboutView.php");
        }

    }
    function moveImage($image,$oldImage)
    {
        $type = $image['type'];
        $imageTmpName = $image['tmp_name'];
        
        $typeImage = pathinfo($image['name'] , PATHINFO_EXTENSION);
        //$typeImage = explode('/', $type)[1];
        

        $chackValidation = $this->valdtionImage($typeImage, ['png','jpeg', 'PNG' , 'jpg', 'webp']);
        var_dump( $chackValidation);

        if ($chackValidation) {

            $newName = '_About' . time() . '.' . $typeImage;
            echo "said";

            //$path = realpath("../../Images") . '/'  . $newName;
            

            move_uploaded_file($imageTmpName, "../../Images/$newName");
            /* مش فاهم الفنكشن unlink  */
            // unlink(realpath("../../Images") . '/'  . $oldImage);
            return $newName;
        } else {
            echo "salah";
            $_SESSION['error'] = "Upload Correct File";
        }
    }

    function valdtionImage($type, $extintions)
    {
        if (in_array($type, $extintions)) {
            return true;
        }
        return false;
    }
}
$about = new AboutController;

if (isset($_POST['submit'])) {

    $userName = $_POST['name'];
    $age = $_POST['age'];
    $live_in = $_POST['live_in'];
    $from = $_POST['from'];
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $oldImage = $_POST['oldImage'];
    //var_dump($oldImage);
    $desc = $_POST['desc'];
    $image = $_FILES['image'];
    $id = $_POST['id'];
    
    if ($image['name']) {
        $urlImage = $about->moveImage($image,$oldImage);
    } else {
        //echo "image";
        $urlImage = $oldImage;
    }
    $data = [$userName, $title, $desc, $from, $live_in, $age, $gender, $urlImage, $id];
    $about->update($data);
    header("Location:../About/aboutView.php");

}
