<?

// тут пишем защиту от атак на сайт

function defender_xss($arr){
    //$filter = array("<", ">"); 
    $filter = array("<", ">","="," (",")",";"); // ,"/"
     foreach($arr as $num => $xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
}
//используйте  функцию перед обработкой входящих данных:
$_REQUEST=defender_xss($_REQUEST);