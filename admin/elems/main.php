<div class="main">
            <div class="container">
                <div class="main__wrapper">
                    <div class="content">
                        <h2 class="content__title">Проверка новых Анекдотов</h2>
                        <p class="content__text">
                            На онлайн сайте «Анекдотов стрит» вы можете совершенно бесплатно читать анекдоты на самые
                            разные темы. Для вас в коллекции есть как самые лучшие и всем известные смешные до слез
                            анекдоты, так и новинки. Читайте сами и делитесь с друзьями.
                        </p>
                        <div class="content__inner">

<?php

    deleteAnecdot($link);
    addNewAnecdot($link);




    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
        $notesOnPage = 3;
        $from = ($page - 1) * $notesOnPage;

    $query = "SELECT checking.id as checking_id, checking.date as checking_date, checking.text as checking_text, checking.subject_id as checking_subject_id, subject.id as subject_id, subject.title as subject_text FROM checking LEFT JOIN subject ON subject.id=checking.subject_id WHERE checking.id>0 LIMIT $from,$notesOnPage";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row );

    foreach($data as $elem) {
    $text = $elem['checking_text'];
    $subject = $elem['subject_text'];
    $date = $elem['checking_date'];
    $id = $elem['checking_id'];

    echo "<div class=\"content__box\">
        <p class=\"content__box-text\">
        $text
        </p>
        <div class=\"content__box-desc\">
            <a class=\"content__box-subject\" href=\"?subject=$id\">
            $subject
            </a>
            <div class=\"content__box-date\">
            $date
            </div>
            <a class=\"content__box-add\" href=\"?added=$id\">
            Добавить
            </a>
            <a class=\"content__box-delete\" href=\"?delete=$id\">
            Удалить
            </a>
        </div>
    </div>";

    }

?>
                            
                        </div>

                        <div class="content__pagination">
<?php


     $query = "SELECT COUNT(*) as count FROM checking";
     $result = mysqli_query($link, $query) or die(mysqli_error($link));
     $count = mysqli_fetch_assoc($result)['count'];

     $pagesCount = ceil($count / $notesOnPage);

     if ($page != 1) {
         $prev = $page - 1;
         echo "<a class=\"pagination__btn\" href=\"?page=$prev\"><</a>";
     } else {
         echo "<a class=\"pagination__btn\" ><</a>";
     }
 
     for ($i = 1; $i <= $pagesCount; $i++) {
         $active = '';
         if ($page == $i) {
             $active = 'pagination__btn-active';
         } 
         echo "<a class=\"pagination__btn $active\" href=\"?page=$i\">$i</a>";
     }
     if ($page == $pagesCount) {
         echo "<a class=\"pagination__btn\" >></a>";
     } else {
         $next = $page + 1;
         echo "<a class=\"pagination__btn\" href=\"?page=$next\">></a>";
     }
    
?>

                        </div>

                    </div>
                    <div class="sidebar">
                        <h3 class="sidebar__title">Анекдоты по темам</h3>
                        <ul class="sidebar__menu">
<?php


// $query = "SELECT * FROM subject WHERE id>0";
// $result = mysqli_query($link, $query) or die(mysqli_error($link));
// for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row );

// foreach($data as $elem) {
//     $id = $elem['id'];
//     $subject = $elem['title'];

//     echo "<li class=\"sidebar__menu-list\">
//     <a class=\"sidebar__menu-link\" href=\"?subject=$id&sub_page=1\">$subject</a>
//     </li>";
// }

?>

                        </ul>
                    </div>
                </div>
            </div>
</div>